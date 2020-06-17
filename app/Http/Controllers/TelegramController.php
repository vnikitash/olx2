<?php

namespace App\Http\Controllers;


use App\Models\Advertisement;
use App\Models\AdvertisementUserSubscription;
use App\Models\TelegramUser;
use App\Services\TelegramService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TelegramController extends Controller
{

    private $service;

    public function __construct(TelegramService $service)
    {
        $this->service = $service;
    }

    public function handle(Request $request)
    {

        try {
            $data = json_encode($requestData = $request->all());

            $chatId = $requestData['message']['from']['id'];

            file_put_contents('test.txt', $data . PHP_EOL, FILE_APPEND);

            $text = $requestData['message']['text'] ?? '';

            if ($text) {
                return $this->handleText($chatId, $text);
            }
        } catch (\Exception $e) {}

        return $this->service->sendMessage($chatId, 'Some test message');

    }

    private function handleText(int $chatId, string $text)
    {

        if (strpos($text ,'/login') !== false) {

            $parts = explode(" ", $text);

            $user = User::query()->where('email', $parts[1])->first();

            if (!$user) {
                return $this->service->sendMessage($chatId, 'Credemtials you are wrote here are incorrent of user does not exists');
            }

            if (Hash::check($parts[2] ?? '', $user->password)) {
                $data =  json_encode($user->toArray());

                TelegramUser::query()->where('user_id', $user->id)->delete();

                $tUser = new TelegramUser();
                $tUser->user_id = $user->id;
                $tUser->chat_id = $chatId;
                $tUser->save();

                return $this->service->sendMessage($chatId, $data);
            }

            $this->service->sendMessage($chatId, 'User not found');
        }

        if (strpos($text ,'/advertisements') !== false) {
            $advertisements = Advertisement::with(['user', 'category'])->limit(10)->get();

            $message = '';


            foreach ($advertisements as $advertisement) {
                $message .= "ID: " . $advertisement['id'] . PHP_EOL;
                $message .= "TITLE: " . $advertisement['title'] . PHP_EOL;
                $message .= "DESCRIPTION: " . $advertisement['description'] . PHP_EOL;
                $message .= "PRICE: " . $advertisement['price'] . "$" . PHP_EOL;
                $message .= "USER: " . $advertisement['user']['name'] . PHP_EOL;
                $message .= "PHONE: " . $advertisement['user']['phone'] . PHP_EOL . PHP_EOL;
            }

            return $this->service->sendMessage($chatId, urlencode($message));
        }

        return $this->service->sendMessage($chatId, 'Unknown command');
    }

    public function subscribe(Request $request)
    {
        $userId = $request->user()->id;
        $chatId = $request->chatId ?? 0;
        $advertisementId = $request->advertisementId ?? 0;

        $s = new AdvertisementUserSubscription();
        $s->user_id = $userId;
        $s->advertisement_id = $advertisementId;
        $s->telegram_user_id = TelegramUser::query()->where('chat_id', $chatId)->first()->id;
        $s->save();

    }
}