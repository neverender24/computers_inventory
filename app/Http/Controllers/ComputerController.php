<?php

namespace App\Http\Controllers;

use App\Computer;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    public function __construct(Computer $model) {
        $this->model = $model;
    }

    public function index(Request $request) {
        $sortFields     = ['modified'];
		$length         = $request->length;
		$column         = $request->column;
		$dir            = $request->dir;
        $searchValue    = $request->search;
        $show           = $request->show;

        $index = $this->model
                    ->with(['office'])
                    ->has('office')
                    ->orderBy($sortFields[$column], $dir);
        $this->search($index, $searchValue);
		$index = $index->paginate($length);

    	return ['data'=>$index, 'draw'=> $request->draw];
    }

    public function show(Request $request, $id) {
        return $this->model->with(['office'])->findOrFail($id);
    }

    public function search($collection, $searchValue) {
        if ($searchValue) {
            return $collection->where(function($query) use($searchValue){
                $query->orWhere('modified','LIKE','%'.$searchValue.'%');
            });
        }
    }
}
