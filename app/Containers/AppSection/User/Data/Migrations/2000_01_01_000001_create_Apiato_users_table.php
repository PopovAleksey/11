<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApiatoUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*Schema::create('users_apiato', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('gender')->nullable();
            $table->string('birth')->nullable();
            $table->string('device')->nullable();
            $table->string('platform')->nullable();
            $table->boolean('is_admin')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        #Schema::drop('users_apiato');
    }
}
