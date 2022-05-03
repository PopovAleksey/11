<?php

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
            $table->bigInteger('seo_id')->unsigned()->index('INDEX_seo_links_seo');
            $table->bigInteger('content_id')->unsigned()->index('INDEX_seo_links_content');
            $table->string('link')->unique();

            $table->timestamps();

            $table->foreign('seo_id', 'FK_seo_links_seo_foreign')
                ->references('id')
                ->on('seo')
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
