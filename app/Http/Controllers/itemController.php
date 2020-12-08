<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\item;
use Illuminate\Support\Facades\DB;

class itemController extends Controller
{
    public function SaveItem(Request $REQUEST){
        $input = $REQUEST->all();
        //dd($REQUEST);

        $REQUEST->validate([
            'Name' => ['required', 'string', 'max:255'],
            'Code' => ['required', 'string', 'unique:Items'],
            'Unit' => ['required', 'string'],
        ]);

        item::create([
            'Name' => $REQUEST['Name'],
            'Code' => $REQUEST['Code'],
            'Unit' => $REQUEST['Unit'],
        ]);
    } 

    public function LoadItems(){
        $items= item::all();
        return $items;
    }

    public function update(Request $request){        
        $request->validate([
            'Name' => ['required', 'string', 'max:255'],
            'Code' => ['required', 'string', 'unique:Items'],
            'Unit' => ['required', 'string'],
        ]);

        $input = $request->all();
        //$Code=Ucode();
        //dd($input);
        $Vendor = item::updateOrCreate(['id'=> $input['ids']],[
            'Name' =>  $request['Name'],
            'Code' =>  $request['Code'],
            'Unit' =>  $request['Unit'],
        ]);
        //$Vendor->save();
    }

    public function Delete(Request $request){  
        $input = $request->all();
        $id = item::destroy($input['ids']);
        
    }   

    public function specificItem(Request $request){
        $details= DB::connection('mysql')->select("SELECT * FROM `items` where Code=?",[$request['code']]);
        
    return $details;
    }
    
}
