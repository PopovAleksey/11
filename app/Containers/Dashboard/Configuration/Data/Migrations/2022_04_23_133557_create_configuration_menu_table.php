<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfigurationMenuTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('configuration_menus', static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('content_id')->unsigned()->index('INDEX_configuration_menu_content');

            $table->timestamps();

            $table->foreign('content_id', 'FK_configuration_menu_content_foreign')
                ->references('id')
                ->on('contents')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuration_menus');
    }
}
