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
            $table->bigInteger('language_id')->unsigned()->index('INDEX_localization_language');
            $table->bigInteger('theme_id')->unsigned()->index('INDEX_localization_theme');
            $table->text('value')->nullable();

            $table->unique(['point', 'language_id', 'theme_id']);
            $table->timestamps();

            $table->foreign('language_id', 'FK_localization_languages_foreign')
                ->references('id')
                ->on('languages')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');

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
