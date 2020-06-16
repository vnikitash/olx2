<?php

namespace App\Services;


use App\Models\Advertisement;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class AdvertisementService
{
    public function getListOfAdvertisements(?int $categoryId = null): Collection
    {
        $advBuilder = Advertisement::with('user');

        if ($categoryId) {
            $advBuilder->where('category_id', $categoryId);
        }

        return $advBuilder->get();
    }

    /**
     * @param int $advertisementId
     * @return Advertisement|null
     */
    public function getAdvertisementInfo(int $advertisementId): ?Advertisement
    {
        /** @var Advertisement $advertisement */
        $advertisement = Advertisement::with('user')
            ->where('id', $advertisementId)
            ->firstOrFail();

        return $advertisement;
    }

    public function updateAdvertisement(int $advertisementId, array $data, User $user): Advertisement
    {
        /** @var Advertisement $adv */
        $adv = Advertisement::query()->findOrFail($advertisementId);

        if (!$this->isAbleToManage($adv, $user)) {
            throw new \Exception("Yot are not permitted to perform this action");
        }

        if (!Arr::has($data, 'title') && !Arr::has($data, 'description') && !Arr::has($data, 'price')) {
            return $adv;
        }

        $adv->title = Arr::get($data, 'title') ?? $adv->title;
        $adv->description = Arr::get($data, 'description') ?? $adv->description;
        $adv->price = Arr::get($data, 'price') ?? $adv->price;
        $adv->save();

        return $adv;
    }

    /**
     * @param $advertisementId
     * @param User $user
     * @return bool
     * @throws \Exception
     */
    public function deleteAdvertisement($advertisementId, User $user): bool
    {

        /** @var Advertisement $adv */
        $adv = Advertisement::query()->findOrFail($advertisementId);

        if (!$this->isAbleToManage($adv, $user)) {
            throw new \Exception("Yot are not permitted to perform this action");
        }

        return (bool) $adv->delete();
    }

    public function createAdvertisement(array $data, User $user, $image = null): Advertisement
    {
        $adv = new Advertisement();
        $adv->title = Arr::get($data, 'title');
        $adv->description = Arr::get($data, 'description');
        $adv->user_id = $user->id;
        $adv->price = Arr::get($data, 'price');
        $adv->category_id = Arr::get($data, 'category_id');
        $adv->save();

        return $adv;
    }

    private function isAbleToManage(Advertisement $advertisement, User $user): bool
    {
        if (!$user->is_admin && $advertisement->user_id !== $user->id) {
            return false;
        }

        return true;
    }
}
