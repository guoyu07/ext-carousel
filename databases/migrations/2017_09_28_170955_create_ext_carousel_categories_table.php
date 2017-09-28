<?php
/**
 * This file is part of Notadd.
 *
 * @datetime 2017-09-28 17:09:55
 */

use Illuminate\Database\Schema\Blueprint;
use Notadd\Foundation\Database\Migrations\Migration;

/**
 * Class CreateExtCarouselCategoriesTable.
 */
class CreateExtCarouselCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('ext_carousel_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('分类名称');
            $table->integer('alias')->comment('分类id');
            $table->integer('user_id')->comment('新增分类用户id');
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
        $this->schema->drop('ext_carousel_categories');
    }
}
