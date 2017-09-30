<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-29 下午2:10
 */

namespace Notadd\Carousel\Handlers;


use Notadd\Carousel\Models\Group;
use Notadd\Foundation\Routing\Abstracts\Handler;

class DeleteGroupHandler extends Handler
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

        $group = Group::where('alias', $this->request->get('group_alias'))->first();
        if (!$group instanceof Group) {
            return $this->withCode(401)->withError('组id不存在');
        }

        //先删除组下面的所有图片
        $pictures = $group->pictures;
        if ($pictures->count() > 0) {
            foreach ($pictures as $picture) {
                $complatePath = base_path('statics' . strstr($picture->path, '/uploads'));
                if (file_exists($complatePath)) {
                    unlink($complatePath);
                }
            }
        }

        if (file_exists(base_path('statics/uploads/' . $group->category_id))) {
            if (file_exists(base_path('statics/uploads/' . $group->category_id . '/' . $group->id))) {
                $groupPath = base_path('statics/uploads/' . $group->category_id . '/' . $group->id);
                rmdir($groupPath);
            }
        }

        if ($group->delete()) {
            return $this->withCode(200)->withMessage('删除组信息成功');
        }
    }
}