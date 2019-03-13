<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $table = "Office";

    public function computers() {
        return $this->hasMany('App\Computer');
    }
}
