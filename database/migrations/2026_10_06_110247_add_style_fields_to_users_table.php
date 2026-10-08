<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Navbar Styling
            $table->string('navbar_text_color')->nullable()->default('#334155');
            $table->string('navbar_font')->nullable()->default('inherit');

            // Footer Styling
            $table->string('footer_text_color')->nullable()->default('#ffffff');
            $table->string('footer_font')->nullable()->default('inherit');

            // Global Font
            $table->string('site_font')->nullable()->default('inherit');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'navbar_text_color',
                'navbar_font',
                'footer_text_color',
                'footer_font',
                'site_font',
            ]);
        });
    }
};