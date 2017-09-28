<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-28 下午5:47
 */

use Illuminate\Database\Eloquent\Model;


class Picture extends Model
{
    protected $table = 'ext_carousel_pictures';
    protected $fillable = [
        'name',
        'path',
        'title',
        'link',
        'group_id',
        'user_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}