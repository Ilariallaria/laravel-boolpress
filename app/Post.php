<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id'
    ];

    // metodo che applicato mi torna un elemento che appartiene alla tabella categories
    public function category(){
        return $this->belongsTo('App\Category');
    }
}
