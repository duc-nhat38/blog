<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function blogs(){
        return $this->hasMany('App\Models\Blog', 'users_id', 'id');
    }
}
