<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-29 上午11:29
 */

namespace Notadd\Carousel\Handlers;


use Notadd\Carousel\Models\Group;
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
        $perPage = $this->request->get('group_perpage', 10);
        $groups = Group::OrderBy('created_at', 'desc')->paginate($perPage);
        return $this->withCode(200)->withData($groups)->withMessage('获取组信息成功');

    }
}