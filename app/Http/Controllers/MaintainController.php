<?php

namespace App\Http\Controllers;

use App\Maintain;
use Illuminate\Http\Request;

class MaintainController extends Controller
{
    public function __construct(Maintain $model) {
        $this->model = $model;
    }

    public function index(Request $request) {
        $computer_id    = $request->computer_id;
        
        return $this->model->where('computer_id', $computer_id)->get();
    }
}
