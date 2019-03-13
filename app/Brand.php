<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table="brand";
    protected $fillable = ['description', 'part_id', 'computer_id'];
    
    public function part() {
        return $this->belongsTo('App\Part');
    }

    public function computer() {
        return $this->belongsTo('App\Computer');
    }
}
