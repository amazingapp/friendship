<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['name','likeable_id','likeable_type','user_id'];

    public function likeable()
    {
        return $this->morphTo();
    }
}
