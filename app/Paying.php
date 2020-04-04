<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paying extends Model
{
    protected $fillable = ['items', 'amount'];
}
