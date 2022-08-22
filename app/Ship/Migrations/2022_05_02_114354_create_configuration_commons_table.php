<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfigurationCommonsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('configuration_commons', static function (Blueprint $table) {
            $table->id();
            $table->string('config')->unique();
            $table->bigInteger('language_id')->unsigned()->nullable()->index('INDEX_configuration_common_languages');
            $table->string('value');

            $table->timestamps();

            $table->foreign('language_id', 'FK_configuration_common_languages_foreign')
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
        Schema::dropIfExists('configuration_commons');
    }
}
