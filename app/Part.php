<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $table = "part";

    public function brands() {
        return $this->hasMany('App\Brand');
    }
}
