<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['photo'];

    public function getPhotoAttribute()
    {
        return "/img/{$this->id}.png";
    }
}
