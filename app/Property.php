<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['uid','name','lat','lng','value'];

}
