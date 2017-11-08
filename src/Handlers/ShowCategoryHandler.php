<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-29 下午3:18
 */

namespace Notadd\Carousel\Handlers;


use Notadd\Carousel\Models\Category;
use Notadd\Foundation\Routing\Abstracts\Handler;

class ShowCategoryHandler extends Handler
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

        $category = Category::query()->where('alias', $this->request->get('category_alias'))->first();
        if (!$category instanceof Category) {
            return $this->withCode(401)->withError('分类id不存在');
        }
        $groups = $category->groups;
        return $this->withCode(200)->withData($groups)->withMessage('获取组信息成功');
    }
}