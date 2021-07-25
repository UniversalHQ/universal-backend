<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guild extends Model
{
    use HasFactory;

    protected $fillable = [
        'discord_id',
        'icon_id',
        'name',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
