<?php
/**
 * This file is part of Notadd.
 *
 * @datetime 2017-09-28 17:09:07
 */

use Illuminate\Database\Schema\Blueprint;
use Notadd\Foundation\Database\Migrations\Migration;

/**
 * Class CreateExtCarouselPicturesTable.
 */
class CreateExtCarouselPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('ext_carousel_pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('图片名称');
            $table->string('title')->comment('图片标题');
            $table->string('path')->comment('图片路径');
            $table->string('link')->comment('图片跳转链接');
            $table->integer('order')->default(0)->comment('图片排序');
            $table->integer('user_id')->comment('图片上传用户id');
            $table->string('group_id')->comment('图片所属组id');
            $table->foreign('group_id')->references('id')->on('ext_carousel_groups')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->drop('ext_carousel_pictures');
    }
}
