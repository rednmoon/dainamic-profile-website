<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hero Section
            $table->string('hero_title')->nullable();
            $table->string('hero_subtitle')->nullable();
            $table->string('hero_bg')->nullable();
            $table->string('hero_button_text')->nullable();
            $table->string('hero_button_url')->nullable();

            // Custom Navbar & Footer Backgrounds
            $table->string('navbar_bg')->nullable();
            $table->string('footer_bg')->nullable();

            // Social & Contact
            $table->string('email_address')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('telegram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
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
            ]);
        });
    }
};