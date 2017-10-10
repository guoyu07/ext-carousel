<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-29 下午2:10
 */

namespace Notadd\Carousel\Handlers;


use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Notadd\Carousel\Models\Group;
use Notadd\Foundation\Routing\Abstracts\Handler;

class DeleteGroupHandler extends Handler
{

    protected $file;

    /**
     * DeleteGroupHandler constructor.
     * @param Container $container
     * @param Filesystem $filesystem
     */
    public function __construct(Container $container, Filesystem $filesystem)
    {
        parent::__construct($container);
        $this->file = $filesystem;
    }

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

        $group = Group::where('alias', $this->request->get('group_alias'))->first();
        if (!$group instanceof Group) {
            return $this->withCode(401)->withError('组id不存在');
        }

        //删除组图文件夹
        $subPath = 'statics/uploads/carousel/';
        if ($this->file->exists(base_path($subPath . $group->category_id))) {
            if ($this->file->exists(base_path($subPath . $group->category_id . '/' . $group->id))) {
                $groupPath = base_path($subPath . $group->category_id . '/' . $group->id);
                $this->file->deleteDirectory($groupPath);
            }
        }

        if ($group->delete()) {
            return $this->withCode(200)->withMessage('删除组信息成功');
        }
    }
}