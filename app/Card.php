<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['id','idLst','owner','data'];
    protected $table = 'cards';
}
