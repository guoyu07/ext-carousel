<?php

use Notadd\Carousel\Models\Category;
use Notadd\Foundation\Routing\Abstracts\Handler;

/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-28 下午6:25
 */

class SetGalleryHandler extends Handler
{

    /**
     * Execute Handler.
     *
     * @throws \Exception
     */
    protected function execute()
    {
        $this->validate($this->request, [
            'category_name' => 'required',
            'category_alias' => 'unique',
        ], [
            'category_name.required' => '请输入分类名称',
            'category_alias.unique' => '分类id在数据库中已经存在，请重新设置',
        ]);

        $category = new Category;
        $category->name = $this->request->get('category_name');
        $category->user_id = 1;

        $alias = $this->request->get('category_alias');
        if (!$alias) {
            do {
                $random = mt_rand(0, 4999);
            } while ($this->verify($random));
            $category->alias = $random;
        } else {
            $category->alias = $alias;
        }

        if ($category->save()) {
            return $this->withCode(200)->withMessage('分类信息保存成功');
        } else{
            return $this->withCode(401)->withError('分类信息保存失败，请稍后重试');
        }
    }

    /**
     * 验证随机生成的分类id是否重复
     * @param $verify
     * @return bool
     */
    private function verify($verify)
    {
        $category = Category::where('alias', $verify);
        if ($category) {
            return true;
        } else{
            return false;
        }
    }
}