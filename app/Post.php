<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','description','poza','content','category_id','status','user_id'];
    public function category(){
        return $this->belongsTo('App\Category');
    }
}
