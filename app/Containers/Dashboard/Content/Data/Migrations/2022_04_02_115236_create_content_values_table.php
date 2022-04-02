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
            $table->bigInteger('content_id')->unsigned()->index('INDEX_content_values_contents');
            $table->bigInteger('page_field_id')->unsigned()->index('INDEX_content_values_page_fields');
            $table->fullText('value')->nullable();

            $table->timestamps();
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
