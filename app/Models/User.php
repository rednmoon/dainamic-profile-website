<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'profile_photo',
        'logo',
        'favicon',
        'about_me',
        'phone',
        'location',
        'theme_color',
        'hero_title',
        'hero_subtitle',
        'hero_bg',
        'hero_button_text',
        'hero_button_url',
        'navbar_bg',
        'footer_bg',
        'email_address',
        'whatsapp',
        'telegram',
        'facebook',
        'instagram',
        'linkedin',
        'youtube',
        'navbar_text_color', 
        'navbar_font',
        'footer_text_color', 
        'footer_font',
        'site_font',
        'usertype',    // Added
        'is_approved', // Added

    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
}