<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintain extends Model
{
    protected $table = "maintain";

    public function computer() {
        return $this->belongsTo('App\Computer');
    }
}
