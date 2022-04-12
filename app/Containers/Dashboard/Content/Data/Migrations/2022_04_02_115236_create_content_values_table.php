<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentValuesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('content_values', static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('language_id')->unsigned()->index('INDEX_contents_languages');
            $table->bigInteger('content_id')->unsigned()->index('INDEX_content_values_contents');
            $table->bigInteger('page_field_id')->unsigned()->index('INDEX_content_values_page_fields');
            $table->text('value')->nullable();

            $table->timestamps();

            $table->foreign('language_id', 'FK_contents_languages_foreign')
                ->references('id')
                ->on('languages')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');

            $table->foreign('content_id', 'FK_content_values_contents_foreign')
                ->references('id')
                ->on('contents')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');

            $table->foreign('page_field_id', 'FK_content_values_page_fields_foreign')
                ->references('id')
                ->on('page_fields')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_values');
    }
}
