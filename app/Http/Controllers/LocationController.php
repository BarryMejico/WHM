<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Locaion;

class LocationController extends Controller
{
    public function treedata(){
        $datatree= Locaion::all();
        return $datatree;
    }
}
