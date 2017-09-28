<?php

namespace Notadd\Carousel\Handler;

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

        $alias = $this->request->get('category_alias');
        $category = Category::where('alias', $alias)->first();

        if (!$category instanceof Category) {
            return $this->withCode(401)->withError('请重新确认分组id');
        }

        if ($category->delete()) {
            return $this->withCode(200)->withMessage('删除分组信息成功');
        }
    }
}