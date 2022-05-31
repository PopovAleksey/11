<?php

use App\Ship\Parents\Models\TemplateWidgetInterface;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTemplateWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('template_widgets', static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('template_id')->unsigned()->unique()->index('INDEX_template_widgets_templates');
            $table->tinyInteger('count_elements')->unsigned()->default(1);
            $table->enum('show_by', [
                TemplateWidgetInterface::SHOW_FIRST,
                TemplateWidgetInterface::SHOW_LAST,
                TemplateWidgetInterface::SHOW_RANDOM,
            ])->default(TemplateWidgetInterface::SHOW_FIRST);
            $table->timestamps();

            $table->foreign('template_id', 'FK_template_widgets_templates_foreign')
                ->references('id')
                ->on('templates')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_widgets');
    }
}
