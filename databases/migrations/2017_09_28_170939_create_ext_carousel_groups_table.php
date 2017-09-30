<?php
/**
 * This file is part of Notadd.
 *
 * @datetime 2017-09-28 17:09:39
 */

use Illuminate\Database\Schema\Blueprint;
use Notadd\Foundation\Database\Migrations\Migration;

/**
 * Class CreateExtCarouselGroupsTable.
 */
class CreateExtCarouselGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('ext_carousel_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('组名');
            $table->integer('alias')->comment('组id');
            $table->boolean('show')->default(true)->comment('是否显示，默认显示');
            $table->integer('user_id')->comment('新增组的用户id');
            $table->integer('category_id')->comment('组所属分类id');
            $table->foreign('category_id')->references('id')->on('ext_carousel_categories')->onDelete('cascade');
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
        $this->schema->drop('ext_carousel_groups');
    }
}
