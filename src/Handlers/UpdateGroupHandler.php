<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-29 上午11:35
 */

namespace Notadd\Carousel\Handlers;


use Notadd\Carousel\Models\Group;
use Notadd\Foundation\Routing\Abstracts\Handler;

class UpdateGroupHandler extends Handler
{

    /**
     * Execute Handler.
     *
     * @throws \Exception
     */
    protected function execute()
    {
        $this->validate($this->request, [
            'group_alias' => 'required',
            'group_name' => 'required',
        ], [
            'group_alias.required' => '请传入组id',
            'group_name.required' => '请输入组图名称',
        ]);

        $group = Group::query()->where('alias', $this->request->get('group_alias'))->first();
        if (!$group instanceof Group) {
            return $this->withCode(401)->withError('组id不存在');
        }
        $group->name = $this->request->get('group_name');
        $group->show = $this->request->get('group_show', true);
        if ($group->save()) {
            return $this->withCode(200)->withMessage('更新组信息成功');
        }
    }
}