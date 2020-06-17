<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class TelegramUser
 * @package App\Models
 *
 * @property int $id
 * @property int $user_id
 * @property int $advertisement_id
 * @property int $telegram_user_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class AdvertisementUserSubscription extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function advertisement(): BelongsTo
    {
        return $this->belongsTo(Advertisement::class);
    }

    public function telegram(): HasOne
    {
        return $this->hasOne(TelegramUser::class, 'id', 'telegram_user_id');
    }
}
