<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-29 上午11:13
 */

namespace Notadd\Carousel\Handlers;


use Notadd\Carousel\Models\Picture;
use Notadd\Foundation\Routing\Abstracts\Handler;

class UpdatePictureHandler extends Handler
{

    /**
     * Execute Handler.
     *
     * @throws \Exception
     */
    protected function execute()
    {
        $this->validate($this->request, [
            'picture_id' => 'required',
        ], [
            'picture_id.required' => '请传入图片id'
        ]);

        $picture = Picture::find($this->request->get('picture_id'));
        if (!$picture instanceof Picture) {
            return $this->withCode(401)->withError('图片id不存在');
        }
        $picture->title = $this->request->get('picture_title', null);
        $picture->link = $this->request->get('picture_link', null);
        $picture->order = $this->request->get('picture_order', 0);
        if ($picture->save()) {
            return $this->withCode(200)->withMessage('更新图片信息成功');
        }
    }
}