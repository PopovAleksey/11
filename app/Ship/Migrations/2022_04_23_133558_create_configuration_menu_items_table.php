<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfigurationMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('configuration_menu_items', static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('menu_id')->unsigned()->index('INDEX_configuration_menu_items_menu');
            $table->bigInteger('content_id')->unsigned()->index('INDEX_configuration_menu_content');
            $table->tinyInteger('order');

            $table->timestamps();

            $table->foreign('menu_id', 'FK_configuration_menu_items_menu_foreign')
                ->references('id')
                ->on('configuration_menus')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');

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
        Schema::dropIfExists('configuration_menu_items');
    }
}
