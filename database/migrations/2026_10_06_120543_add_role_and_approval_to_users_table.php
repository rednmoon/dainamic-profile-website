<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // usertype: 'admin' অথবা 'user' (default: user)
            $table->string('usertype')->default('user')->after('email');
            
            // is_approved: 0 = Pending/Unapproved, 1 = Approved
            $table->boolean('is_approved')->default(false)->after('usertype');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['usertype', 'is_approved']);
        });
    }
};