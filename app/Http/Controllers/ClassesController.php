<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;

class ClassesController extends Controller
{
    public function index() {
        $classes = ClassModel::orderBy('day')
        ->orderBy('time')
        ->get()
        ->groupBy('day');
        return response()->json($classes);
    }
}