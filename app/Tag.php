<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['name'];

    protected $table = 'tags';

    public function tagToPost() {
        return $this->belongsToMany('App\Post', 'post_tag', 'tag_id', 'post_id');
    }
}
