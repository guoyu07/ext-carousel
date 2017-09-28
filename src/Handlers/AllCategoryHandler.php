<?php

use Notadd\Carousel\Models\Category;
use Notadd\Foundation\Routing\Abstracts\Handler;

/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-28 下午6:08
 */

class AllCategoryHandler extends Handler
{

    /**
     * Execute Handler.
     *
     * @throws \Exception
     */
    protected function execute()
    {

        $perPage = $this->request->get(category_perpage, 10);
        $categories = Category::OrderBy('created_at', 'desc')->paginate($perPage);
        return $this->withCode(200)->withData($categories)->withMessage('获取数据成功');
    }
}