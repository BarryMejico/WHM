<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\item;
use Illuminate\Support\Facades\DB;
use App\Rules\inUseData;

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
        $request->validate([
            'Name' => ['required', 'string', 'max:255'],
            'Code' => ['required', 'string', 'unique:Items'],
            'Unit' => ['required', 'string'],
        ]);

<<<<<<< Updated upstream
        $input = $request->all();
        //$Code=Ucode();
        //dd($input);
        $Vendor = item::updateOrCreate(['id'=> $input['ids']],[
            'Name' =>  $request['Name'],
            'Code' =>  $request['Code'],
            'Unit' =>  $request['Unit'],
        ]);
        //$Vendor->save();
=======
        
        $customer = item::where('Code',$input['ids'])
        ->update([
           'Name'=> $input['Name'],
           'Unit'=> $input['Unit'],
           //'Address'=> $input['Address'],
        ]);
        
>>>>>>> Stashed changes
    }

    public function Delete(Request $request){  
        $input = $request->all();

        $request->validate([
            
            'ids' => ['required', new inUseData]
            
        ]);

        $id = item::destroy($input['ids']);
        $customer = item::where('Code',$input['ids'])->delete();
        
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
