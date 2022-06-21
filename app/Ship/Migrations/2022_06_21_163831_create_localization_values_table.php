<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocalizationValuesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('localization_values', static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('localization_id')->unsigned()->index('INDEX_localization_localization_value');
            $table->bigInteger('language_id')->unsigned()->index('INDEX_localization_value_language');
            $table->text('value')->nullable();

            $table->timestamps();

            $table->foreign('language_id', 'FK_localization_languages_foreign')
                ->references('id')
                ->on('languages')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('localization_values');
    }
}
