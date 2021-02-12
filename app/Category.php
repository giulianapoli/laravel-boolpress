<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['name'];

    protected $table = 'categories';


    public function categoryToPost() {
        return $this->hasMany('App\Post', 'category_id', 'id');


    }
}
