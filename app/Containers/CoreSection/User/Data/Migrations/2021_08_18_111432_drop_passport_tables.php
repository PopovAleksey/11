<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DropPassportTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('oauth_auth_codes');
        Schema::dropIfExists('oauth_access_tokens');
        Schema::dropIfExists('oauth_refresh_tokens');
        Schema::dropIfExists('oauth_clients');
        Schema::dropIfExists('oauth_personal_access_clients');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
