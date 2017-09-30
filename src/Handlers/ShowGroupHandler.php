<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-29 下午3:25
 */

namespace Notadd\Carousel\Handlers;


use Notadd\Carousel\Models\Group;
use Notadd\Foundation\Routing\Abstracts\Handler;

class ShowGroupHandler extends Handler
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
        ], [
            'group_alias.required' => '请传入组id',
        ]);

        $groupAlias = $this->request->get('group_alias');
        $group = Group::where('alias', $groupAlias)->first();
        if (!$group instanceof Group) {
            return $this->withCode(401)->withError('组id不存在');
        }
        $pictures = $group->pictures;
        return $this->withCode(200)->withData($pictures)->withMessage('获取数据成功');
    }
}