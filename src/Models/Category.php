<?php

use Illuminate\Database\Eloquent\Model;

/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-28 下午6:01
 */

class Category extends Model
{
    protected $table = 'ext_carousel_categories';
    protected $fillable = [
        'name',
        'alias',
        'user_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}