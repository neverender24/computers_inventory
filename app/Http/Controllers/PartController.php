<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartController extends Controller
{
    public function __construct(Part $model) {
        $this->model = $model;
    }

    public function index() {
        return $this->model->all();
    }
}
