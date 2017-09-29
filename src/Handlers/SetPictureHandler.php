<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-29 上午10:20
 */

namespace Notadd\Carousel\Handler;


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
        $group = Group::where('alias', $alias)->first();
        if (!$group instanceof Group) {
            return $this->withCode(401)->withError('组id不存在');
        }
        $title = $this->request->get('picture_title');
        $link = $this->request->get('picture_link');
        $order = $this->request->get('picture_order', 0);
        $img = $this->request->file('file');

        $hash = hash_file('md5', $img->getPathname());
        $random = random_int(0, 9999999);
        $fileName = $hash . $random . '.' . $img->getClientOriginalExtension();     //上传后的文件名

        $groupPath = $group->id;
        $categoryPath = $group->category_id;
        $directory = base_path('statics/uploads/' . $categoryPath . '/' . $groupPath);      //上传文件路径

        if (!file_exists($directory. '/' . $fileName)) {
            $img->move($directory, $fileName);
        }

        $path = url('uploads/' . $categoryPath . '/' . $groupPath . '/' . $fileName);       //保存到数据库的路径

        //图片信息存到数据库
        $picture = new Picture;
        $picture->title = $title;
        $picture->link = $link;
        $picture->order = $order;
        $picture->name = $img->getClientOriginalName();
        $picture->path = $path;
        $picture->user_id = 1;
        $picture->group_id = $group->id;

        return $this->withCode(200)->withMessage('图片上传成功');
    }
}