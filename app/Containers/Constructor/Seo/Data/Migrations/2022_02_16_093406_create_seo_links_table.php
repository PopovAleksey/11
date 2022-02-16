<?php

use App\Containers\Constructor\Seo\Models\SeoInterface;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeoLinksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seo_links', static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('page_id')->unsigned()->index('INDEX_seo_links_pages');
            $table->bigInteger('page_field_id')->unsigned()->index('INDEX_seo_links_page_fields');
            $table->bigInteger('language_id')->unsigned()->index('INDEX_seo_links_languages');
            $table->string('link');
            $table->enum('case_type', [
                SeoInterface::CAMEL_CASE,
                SeoInterface::PASCAL_CASE,
                SeoInterface::SNAKE_CASE,
                SeoInterface::KEBAB_CASE,
            ])->default(SeoInterface::KEBAB_CASE);
            $table->boolean('static')->default(true)
                ->comment('true - not change link during changing a value of referenced field; false - change link if customer changing a value if referenced field in page_field_id');
            $table->boolean('active')->default(true);

            $table->timestamps();

            $table->foreign('page_id', 'FK_seo_links_pages_foreign')
                ->references('id')
                ->on('pages')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');

            $table->foreign('page_field_id', 'FK_seo_links_page_fields_foreign')
                ->references('id')
                ->on('page_fields')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');

            $table->foreign('language_id', 'FK_seo_links_languages_foreign')
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
        Schema::dropIfExists('seo_links');
    }
}
