<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-29 下午2:39
 */

namespace Notadd\Carousel\Handlers;


use Notadd\Carousel\Models\Category;
use Notadd\Foundation\Routing\Abstracts\Handler;

class UpdateCategoryHandler extends Handler
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
            'category_name' => 'required',
        ], [
            'category_alias.required' => '请传入分类id',
            'category_name.required' => '请输入分类名称',
        ]);

        $category = Category::query()->where('alias', $this->request->get('category_alias'))->first();
        if (!$category instanceof Category) {
            return $this->withCode(401)->withError('分类id不存在');
        }
        $category->name = $this->request->get('category_name');
        if ($category->save()) {
            return $this->withCode(200)->withMessage('更新分类信息成功');
        }
    }
}