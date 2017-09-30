<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-29 下午1:42
 */

namespace Notadd\Carousel\Handlers;


use Notadd\Carousel\Models\Category;
use Notadd\Carousel\Models\Group;
use Notadd\Foundation\Routing\Abstracts\Handler;

class SetGroupHandler extends Handler
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
            'group_name' => 'required',
            'group_alias' => 'nullable|unique',
        ], [
            'category_id.required' => '请传入组所属分类id',
            'group_name.required' => '请输入组名',
            'group_alias.unique' => '组id已存在，请重新设置',
        ]);

        $category = Category::where('alias', $this->request->get('category_alias'))->first();
        if (!$category instanceof Category) {
            return $this->withCode(401)->withError('分类id不存在');
        }
        $group = new Group();
        $group->name = $this->request->get('group_name');

        if (!$this->request->get('group_alias')) {
            do {
                $random = mt_rand(0, 4999);
            } while($this->verify($random));
            $group->alias = $random;
        } else {
            $group->alias = $this->request->get('group_alias');
        }

        $group->user_id = 1;
        $group->category_id = $category->id;

        if ($group->save()) {
            return $this->withCode(200)->withMessage('新增组信息成功');
        }
    }

    /**
     * 验证组id是否重复
     * @param $verify
     * @return bool
     */
    private function verify($verify)
    {
        $group = Group::where('alias', $verify)->first();
        if ($group instanceof Group) {
            return true;
        } else {
            return false;
        }
    }
}