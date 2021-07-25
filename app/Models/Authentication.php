<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Authentication
 *
 * @package App\Models
 * @mixin IdeHelperWar
 */
class Authentication extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'user_id',
        'access_token',
        'refresh_token',
        'expires_in',
        'scope',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
