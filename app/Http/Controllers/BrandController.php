<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct(Brand $model) {
        $this->model = $model;
    }

    public function index(Request $request) {
        $computer_id    = $request->computer_id;
        $part_id        = $request->part_id;

        return $this->model->with(["part"])->where('computer_id', $computer_id)->get();
    }

    public function update(Request $request, $id) {
        $item = $this->model->findOrFail($id);
        $item->update($request->all());
    }

    public function destroy($id) {
        $item = $this->model->findOrFail($id);
        $item->delete();
    }
}
