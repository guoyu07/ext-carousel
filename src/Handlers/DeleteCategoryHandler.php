<?php

namespace Notadd\Carousel\Handlers;

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

        $category = Category::where('alias', $this->request->get('category_alias'))->first();

        if (!$category instanceof Category) {
            return $this->withCode(401)->withError('请重新确认分组id');
        }

        //删除分类下面的所有分组信息
        if ($category->groups->count() > 0) {
            foreach ($category->groups as $group) {
                if ($group->pictures->count() > 0) {
                    foreach ($group->pictures as $picture) {
                        $complatePath = base_path('statics' . strstr($picture->path, '/uploads'));
                        if (file_exists($complatePath)) {
                            unlink($complatePath);
                        }
                    }
                }
                if (file_exists(base_path('statics/uploads/carousel/' . $category->id))) {
                    if (file_exists(base_path('statics/uploads/carousel/' . $category->id . '/' . $group->id))) {
                        $groupPath = base_path('statics/uploads/carousel/' . $category->id . '/' . $group->id);
                        rmdir($groupPath);
                    }
                }
            }
        }
        if (file_exists(base_path('statics/uploads/carousel/' . $category->id))) {
            $categoryPath = base_path('statics/uploads/carousel/' . $category->id);
            rmdir($categoryPath);
        }

        if ($category->delete()) {
            return $this->withCode(200)->withMessage('删除分组信息成功');
        }
    }
}