<?php
/**
 * This file is part of Notadd.
 *
 * @datetime 2017-09-30 12:54:45
 */

use Illuminate\Database\Schema\Blueprint;
use Notadd\Foundation\Database\Migrations\Migration;

/**
 * Class EditExtCarouselPicturesTable.
 */
class EditExtCarouselPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->table('ext_carousel_pictures', function (Blueprint $table) {
            $table->string('title')->nullable()->comment('图片标题')->change();
            $table->string('link')->nullable()->comment('图片链接')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
