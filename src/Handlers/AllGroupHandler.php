<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-29 上午11:29
 */

namespace Notadd\Carousel\Handler;


use Notadd\Carousel\Models\Category;
use Notadd\Foundation\Routing\Abstracts\Handler;

class AllGroupHandler extends Handler
{

    /**
     * Execute Handler.
     *
     * @throws \Exception
     */
    protected function execute()
    {
        $this->validate($this->request, [
            'category_id' => 'required',
        ], [
            'category_id.required' => '请传入分类id',
        ]);

        $category = Category::find($this->request->get('category_id'));
        if (!$category instanceof Category) {
            return $this->withCode(401)->withError('分类id不存在');
        }
        $groups = $category->groups();
        return $this->withCode(200)->withData($groups)->withMessage('获取组信息成功');

    }
}