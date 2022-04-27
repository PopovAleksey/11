<?php

use App\Containers\Constructor\Page\Models\PageFieldInterface;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePageFieldsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('page_fields', static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('page_id')->unsigned()->index('INDEX_page_fields_pages');
            $table->string('name');
            $table->enum(
                'type',
                [
                    PageFieldInterface::INPUT_TYPE,
                    PageFieldInterface::TEXTAREA_TYPE,
                    PageFieldInterface::SELECT_TYPE,
                    PageFieldInterface::SELECT_MULTIPLE_TYPE,
                    PageFieldInterface::RADIO_TYPE,
                    PageFieldInterface::CHECKBOX_TYPE,
                    PageFieldInterface::FILE_TYPE,
                ]
            )->default(PageFieldInterface::INPUT_TYPE);
            $table->string('placeholder')->nullable();
            $table->string('mask')->nullable();
            $table->json('values')->nullable();
            $table->boolean('active')->default(true);

            $table->timestamps();

            $table->foreign('page_id', 'FK_page_fields_pages_foreign')
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
        Schema::dropIfExists('page_fields');
    }
}
