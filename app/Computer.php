<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $table = 'computer';

    public function office() {
        return $this->belongsTo('App\Office');
    }

    public function maintains() {
        return $this->hasMany('App\Maintain');
    }
}
