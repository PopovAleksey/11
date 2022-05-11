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
            $table->string('name');
            $table->boolean('active')->default(true);
            $table->bigInteger('template_id')->nullable()->unique()->unsigned()->index('INDEX_configuration_menu_template');

            $table->timestamps();

            $table->foreign('template_id', 'FK_configuration_menu_template_foreign')
                ->references('id')
                ->on('templates')
                ->onUpdate('CASCADE')
                ->onDelete('NO ACTION');
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
