<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // metodo che mi torna gli elementi in relazione con la tabella Post
    public function post(){
        return $this->hasMany('App\Post');
    }
}
