<?php
/**
 * Created by PhpStorm.
 * User: bc-033
 * Date: 17-10-16
 * Time: 下午6:02
 */

namespace Tests\Features;


use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * @test
     */
    public function categoryList()
    {
        $this->json('post', '/api/carousel/category/all')
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function createCategory()
    {
        $this->json('post', 'api/carousel/category/set', ['category_name' => 'category1', 'category_alias' => '1111'])
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function deleteCategory()
    {
        $this->json('post', 'api/carousel/category/delete', ['category_alias' => '1111'])
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function updateCategory()
    {
        $this->json('post', 'api/carousel/category/update', ['category_alias' => '1111', 'category_name' => 'category111'])
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function showCategory()
    {
        $this->json('post', 'api/carousel/category/show', ['category_alias' => '1111'])
            ->assertStatus(200);
    }
}