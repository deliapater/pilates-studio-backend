<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Http\Requests\StoreClassRequest;
use App\Http\Requests\UpdateClassRequest;

class ClassController extends Controller
{
    public function index() 
    {
        $classes = ClassModel::orderBy('day')
        ->orderBy('time')
        ->get()
        ->groupBy('day');
        return response()->json($classes);
    }

    public function store(StoreClassRequest $request)
    {
       $class = ClassModel::create($request->validated());
       return response()->json($class, 201);
    }

    public function update(UpdateClassRequest $request, $id)
    {
        $class = ClassModel::findOrFail($id);
        $class->update($request->validated());
        return response()->json($class);
    }

    public function destroy(Request $request, $id)
    {
        if(!$request->user()->isAdmin()) {
            return response()->json(['message' =>'Unauthorized'], 403);
        }
        $class = ClassModel::findOrFail($id);
        $class->delete();
        return response()->json(['message' => 'Class deleted']);
    }
}