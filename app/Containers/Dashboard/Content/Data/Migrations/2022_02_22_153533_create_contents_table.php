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
