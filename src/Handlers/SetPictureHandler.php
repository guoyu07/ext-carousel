<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-29 上午10:20
 */

namespace Notadd\Carousel\Handlers;


use Notadd\Carousel\Models\Group;
use Notadd\Carousel\Models\Picture;
use Notadd\Foundation\Routing\Abstracts\Handler;

class SetPictureHandler extends Handler
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
            'file' => 'required|image',
        ], [
            'group_alias.required' => '请传入组id',
            'file.required' => '请选择图片',
            'file.image' => '上传文件必须为图片',
        ]);

        $alias = $this->request->get('group_alias');
        $group = Group::query()->where('alias', $alias)->first();
        if (!$group instanceof Group) {
            return $this->withCode(401)->withError('组id不存在');
        }
        $title = $this->request->get('picture_title', null);
        $link = $this->request->get('picture_link', null);
        $order = $this->request->get('picture_order', 0);
        $img = $this->request->file('file');

        $hash = hash_file('md5', $img->getPathname());
        $random = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_BOTH);
        $fileName = $hash . $random . '.' . $img->getClientOriginalExtension();     //上传后的文件名

        $groupPath = $group->id;
        $categoryPath = $group->category_id;
        $directory = base_path('public/uploads/carousel/' . $categoryPath . '/' . $groupPath);      //上传文件路径

        if (!file_exists($directory. '/' . $fileName)) {
            $img->move($directory, $fileName);
        }

        $path = url('uploads/carousel/' . $categoryPath . '/' . $groupPath . '/' . $fileName);       //保存到数据库的路径

        //图片信息存到数据库
        $picture = new Picture;
        $picture->title = $title;
        $picture->link = $link;
        $picture->order = $order;
        $picture->name = $img->getClientOriginalName();
        $picture->path = $path;
        $picture->user_id = 1;
        $picture->group_id = $group->id;

        if ($picture->save()) {
            return $this->withCode(200)->withMessage('图片上传成功');
        }
    }
}