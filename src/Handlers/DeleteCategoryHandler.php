<?php

namespace Notadd\Carousel\Handlers;

use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Notadd\Carousel\Models\Category;
use Notadd\Foundation\Routing\Abstracts\Handler;

/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-28 下午6:51
 */

class DeleteCategoryHandler extends Handler
{

    protected $file;

    public function __construct(Container $container, Filesystem $filesystem)
    {
        parent::__construct($container);
        $this->file = $filesystem;
    }

    /**
     * Execute Handler.
     *
     * @throws \Exception
     */
    protected function execute()
    {
        $this->validate($this->request, [
            'category_alias' => 'required',
        ], [
            'category_alias.required' => '请传入分类id',
        ]);

        $category = Category::query()->where('alias', $this->request->get('category_alias'))->first();

        if (!$category instanceof Category) {
            return $this->withCode(401)->withError('请重新确认分组id');
        }

        //删除分类下面的所有图片文件
        $subPath = 'public/uploads/carousel/';
        if ($this->file->exists(base_path($subPath . $category->id))) {
            $categoryPath = base_path($subPath . $category->id);
            $this->file->deleteDirectory($categoryPath);
        }

        if ($category->delete()) {
            return $this->withCode(200)->withMessage('删除分组信息成功');
        }
    }
}