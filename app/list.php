<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class List extends Model
{
    protected $fillable = ['id','name'];
    protected $table = 'lists';
}
