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
            'status'=>1,
        ]);
    } 

    public function LoadItems(){
        $items= item::all();
        return $items;
    }

    public function update(Request $request){        
        $input = $request->all();
        //$Code=Ucode();
        //dd($input);
        
        $request->validate([
            'Name' => ['required', 'string', 'max:255'],
            'Code' => ['required', 'string'],
            'Unit' => ['required', 'string'],
        ]);

        
       

        $item = item::find($input['ids']);
        $item ->Name= $input['Name'];
        $item ->Code= $input['Code'];
        $item ->Unit= $input['Unit']; 
               
        $item->save(); 
        
    }

    public function Delete(Request $request){  
        $input = $request->all();
        $id = item::destroy($input['ids']);
        
    }   

    public function specificItem(Request $request){
        $details= DB::connection('mysql')->select("SELECT * FROM `items` where Code=?",[$request['code']]);
        
    return $details;
    }

    public function Search(Request $request){
        $input = $request->all();
        //$search = VendorModel::find($input['Search']);
        $s= $input['Search'];
        $search = DB::table('items')
                ->where('Name', 'like', "%{$s}%")
                ->get();
        
        //dd($input);
        return $search;
    }
    
}
