<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contents', static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('language_id')->unsigned()->index('INDEX_contents_languages');
            $table->bigInteger('page_id')->unsigned()->index("INDEX_contents_pages");
            $table->boolean('active')->default(true);

            $table->timestamps();

            $table->foreign('language_id', 'FK_contents_languages_foreign')
                ->references('id')
                ->on('languages')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');

            $table->foreign('page_id', 'FK_contents_pages_foreign')
                ->references('id')
                ->on('pages')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
}
