<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pages', static function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('parent_page_id')->unsigned()->index('INDEX_pages_pages')->nullable();
            $table->enum('type', ['simple', 'blog', 'category'])->default('simple');
            $table->boolean('active')->default(true);

            $table->timestamps();

            $table->foreign('parent_page_id', 'FK_pages_pages_foreign')
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
        Schema::dropIfExists('pages');
    }
}
