<?php

use App\Containers\Constructor\Template\Models\TemplateInterface;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('templates', static function (Blueprint $table) {
            $table->id();
            $table->enum('type', [
                TemplateInterface::BASE_TYPE,
                TemplateInterface::JS_TYPE,
                TemplateInterface::CSS_TYPE,
                TemplateInterface::PAGE_TYPE,
            ])->default(TemplateInterface::PAGE_TYPE);
            $table->bigInteger('theme_id')->unsigned()->index('INDEX_templates_themes');
            $table->bigInteger('page_id')->unsigned()->nullable()->index('INDEX_templates_pages');
            $table->bigInteger('language_id')->unsigned()->index('INDEX_templates_languages');
            $table->longText('html')->nullable();
            $table->timestamps();

            $table->foreign('theme_id', 'FK_templates_themes_foreign')
                ->references('id')
                ->on('themes')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');

            $table->foreign('page_id', 'FK_templates_pages_foreign')
                ->references('id')
                ->on('pages')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');

            $table->foreign('language_id', 'FK_templates_languages_foreign')
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
        Schema::dropIfExists('templates');
    }
}
