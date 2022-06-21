<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocalizationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('localizations', static function (Blueprint $table) {
            $table->id();
            $table->string('point');
            $table->bigInteger('theme_id')->unsigned()->index('INDEX_localization_theme')->nullable();

            $table->unique(['point', 'theme_id']);
            $table->timestamps();

            $table->foreign('theme_id', 'FK_localization_theme_foreign')
                ->references('id')
                ->on('themes')
                ->onUpdate('CASCADE')
                ->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('localizations');
    }
}
