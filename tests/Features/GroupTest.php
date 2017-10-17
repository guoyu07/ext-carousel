<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-10-17 下午10:54
 */

namespace Tests\Features;


use Tests\TestCase;

class GroupTest extends TestCase
{
    /**
     * @test
     */
    public function allCategory()
    {
        $this->json('post', 'api/carousel/group/all')
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function createGroup()
    {
        $this->json('post', 'api/carousel/group/set', ['group_name' => 'group1', 'category_alias' => '1111', 'group_alias' => '2222'])
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function deleteGroup()
    {
        $this->json('post', 'api/carousel/group/delete', ['group_alias' => '2222'])
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function updateGroup()
    {
        $this->json('post', 'api/carousel/group/update', ['group_alias' => '2222', 'group_name' => 'group111'])
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function showGroup()
    {
        $this->json('post', 'api/carousel/group/show', ['group_alias' => '2222'])
            ->assertJson(200);
    }
}