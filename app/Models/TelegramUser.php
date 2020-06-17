<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class TelegramUser
 * @package App\Models
 *
 * @property int $id
 * @property int $user_id
 * @property int $chat_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class TelegramUser extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
