<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-10-17 下午11:10
 */

namespace Tests\Features;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PictureTest extends TestCase
{
    /**
     * @test
     */
    public function createPicture()
    {
        Storage::fake('images');

        $this->json('post', 'api/carousel/picture/set', [
            'file' => UploadedFile::fake()->image('file.jpg'),
            'group_alias' => '2222',
        ])
            ->assertStatus(200);

        Storage::disk('images')->assertExists('file.jpg');
    }

    /**
     * @test
     */
    public function deletePicture()
    {
        $this->json('post', 'api/carousel/picture/delete', ['picture_id' => 1])
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function updatePicture()
    {
        $this->json('post', 'api/carousel/picture/update', ['picture_id' => 1])
            ->assertStatus(200);
    }
}