<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $fillable = [
        'youtube_url',
        'telegram_url',
        'instagram_url',
        'facebook_url',
    ];
}
