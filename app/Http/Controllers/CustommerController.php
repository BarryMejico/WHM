<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\DB;

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
        $Vendor->save();
    }

    public function update(Request $request){        
        $request->validate([
            'Name'=>'required',
            'Number'=>'required',
            'Address'=>'required'  
        ]);
        $input = $request->all();
        $Code=Ucode();
        //dd($input);
        $customer = Customer::find($input['ids']);
        
    
        $customer ->Customer= $input['Name'];
        $customer ->Number= $input['Number'];
        $customer ->Address= $input['Address']; 
               
        $customer->save(); 
    }


    public function LoadCus(){
            $Vendors=Customer::all();
            return $Vendors;
        
    }

    public function Search(Request $request){
        $input = $request->all();
        //$search = VendorModel::find($input['Search']);
        $s= $input['Search'];
        $search = DB::table('customers')
                ->where('Customer', 'like', "%{$s}%")
                ->get();
        
        //dd($input);
        return $search;
    }
}
