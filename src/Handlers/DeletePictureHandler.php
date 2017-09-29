<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-29 上午11:03
 */

namespace Notadd\Carousel\Handler;


use Notadd\Carousel\Models\Picture;
use Notadd\Foundation\Routing\Abstracts\Handler;

class DeletePictureHandler extends Handler
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
            'picture_id.required' => '请传入图片id',
        ]);

        $picture = Picture::find($this->request->get('picture_id'));
        $filePath = strstr($picture->path, '/uploads');
        $complatePath = base_path('statics' . $filePath);
        if (file_exists($complatePath)) {
            rmdir($complatePath);
        }
        if ($picture->delete()) {
            return $this->withCode(200)->withMessage('删除图片信息成功');
        }
    }
}