<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
class MenuController extends Controller
{
    public function menu(){
        
            $Menu=Menu::all();
            return $Menu;
        
    }
}
