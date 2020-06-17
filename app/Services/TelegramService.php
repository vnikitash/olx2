<?php

namespace App\Services;


use App\Models\Advertisement;
use App\Models\AdvertisementUserSubscription;
use GuzzleHttp\Client;

class TelegramService
{

    private $token;

    public function __construct()
    {
        $this->token = env('TELEGRAM_BOT_TOKEN');
    }

    public function sendMessage(int $chatId, string $message)
    {
        $url = "https://api.telegram.org/bot{$this->token}/sendMessage?chat_id={$chatId}&text={$message}";

        $client = new Client();
        $res = $client->post($url);
        $response = $res->getBody()->getContents();
    }

    public function notifyPriceChanged(Advertisement $advertisement, float $oldPrice)
    {
        $a = AdvertisementUserSubscription::with('telegram')
            ->where('advertisement_id', $advertisement->id)
            ->get()
            ->toArray();

        foreach ($a as $adv) {
            $this->sendMessage($adv['telegram']['chat_id'], 'Price from advertisement ' . "[" . $advertisement->id . "] {$advertisement->title}" . "has been changed from $oldPrice$ to " . $advertisement->price . "$");
        }
    }

    public function notifyRemoved(Advertisement $advertisement)
    {

        $a = AdvertisementUserSubscription::with('telegram')
            ->where('advertisement_id', $advertisement->id)
            ->get()
            ->toArray();

        foreach ($a as $adv) {
            $this->sendMessage($adv['telegram']['chat_id'], 'Item ' . "[" . $advertisement->id . "] {$advertisement->title}" . " has been SOLD!");
        }

        AdvertisementUserSubscription::with('telegram')
            ->where('advertisement_id', $advertisement->id)
            ->delete();

        return;
    }
}