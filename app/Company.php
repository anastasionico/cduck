<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
 	protected $guarded = [];
    public $timestamps = false;

    public function employee()
    {
        return $this->hasMany('App\Employee');
    }
}
