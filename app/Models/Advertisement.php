<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Advertisement
 * @package App\Models
 * @property int $id
 * @property string $title
 * @property string $description
 * @property float $price
 * @property int $user_id
 * @property int $category_id
 * @property string $image_url
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Advertisement extends Model
{

    public $hidden = [
        'updated_at', 'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}