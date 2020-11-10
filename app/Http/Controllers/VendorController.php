<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VendorModel;
use Illuminate\Support\Facades\App;
use App\Helper\Ucode;
use App\Ucode\Ucode as UcodeUcode;

class VendorController extends Controller
{
    public function index(){
        $Vendors=VendorModel::all();
        return $Vendors;
    }

      public function store(Request $request){        
        $request->validate([
            'Name'=>'required',
            'Number'=>'required',
            'Address'=>'required'  
        ]);
        $input = $request->all();
        $Code=Ucode();
        //dd($input);
        $Vendor = VendorModel::updateOrCreate(['id'=> $input['ids']],[
            'Vendor'=> $input['Name'],
            'Number'=> $input['Number'],
            'Address'=> $input['Address'], 
            'Vcode'=>$Code,
        ]);
        //$Vendor->save(); 
    }

    public function Delete(Request $request){  
        $input = $request->all();
        $id = VendorModel::destroy($input['ids']);
        
    }   
}
