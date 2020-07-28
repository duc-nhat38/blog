<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User', 'users_id', 'id');
    }
}
