<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
//    protected $fillable = ['name', 'image', 'display_order'];
    protected $guarded = [];

    public function menuItems()
    {
        return $this->hasMany('App\MenuItem');
    }
}
