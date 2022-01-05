<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLoggersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loggers', static function (Blueprint $table) {
            $table->id();
            $table->string('hash');
            $table->string('request')->nullable();
            $table->enum('type', ['sql'])->default('sql');
            $table->text('query');
            $table->json('bindings');
            $table->integer('time');

            $table->timestamps();

            $table->engine = 'MyISAM';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loggers');
    }
}
