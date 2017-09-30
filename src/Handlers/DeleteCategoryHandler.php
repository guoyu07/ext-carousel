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
                    $groupPath = base_path('statics' . substr(strstr($complatePath, '/uploads'), 0, strrpos(strstr($complatePath, '/uploads'), '/')));
                    if (file_exists($groupPath)) {
                        rmdir($groupPath);
                    }
                }
            }
            $categoryPath = base_path('statics' . substr(strstr($groupPath, '/upload'), 0, strrpos(strstr($groupPath, '/upload'), '/')));
            if (file_exists($categoryPath)) {
                rmdir($categoryPath);
            }
        }

        if ($category->delete()) {
            return $this->withCode(200)->withMessage('删除分组信息成功');
        }
    }
}