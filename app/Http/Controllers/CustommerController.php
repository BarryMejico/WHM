<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
class CustommerController extends Controller
{
    public function store(Request $request){        
        $request->validate([
            'Name'=>'required',
            'Number'=>'required',
            'Address'=>'required'  
        ]);
        $input = $request->all();
        $Code=Ucode();
        //dd($input);
        $Vendor = Customer::updateOrCreate(['id'=> $input['ids']],[
            'Customer'=> $input['Name'],
            'Number'=> $input['Number'],
            'Address'=> $input['Address'], 
            'Ccode'=>$Code,
        ]);
        //$Vendor->save();
    }

    public function LoadCus(){
            $Vendors=Customer::all();
            return $Vendors;
        
    }
}
