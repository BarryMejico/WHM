<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\DB;
use App\Rules\inUseData;

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
        $Vendor = Customer::updateOrCreate([
            'Customer'=> $input['Name'],
            'Number'=> $input['Number'],
            'Address'=> $input['Address'], 
            'Ccode'=>$Code,
        ]);
        $Vendor->save();

        $customer = Customer::where('Ccode',$Code)->get();
        return $customer;
    }

    public function Delete(Request $request){  
        $input = $request->all();
        //dd($input);
        $request->validate([
            'Ccode'=>['required', new inUseData],
        ]);
        $customer = Customer::where('Ccode',$input['Ccode'])->delete();
    }   

    public function update(Request $request){        
 
        $request->validate([
            'Name'=>'required',
            'Number'=>'required',
            'Address'=>'required'  
        ]);

        $input = $request->all();
       
        $customer = Customer::where('Ccode',$input['ids'])
        ->update([
           'Customer'=> $input['Name'],
           'Number'=> $input['Number'],
           'Address'=> $input['Address'],
        ]);
    }


    public function LoadCus(){
            //$Vendors=Customer::all();
            $Vendors=Customer::paginate(5);
            return $Vendors;
    }

    public function LoadlistCus(){
        $Vendors=Customer::all();
        //$Vendors=Customer::paginate(5);
        return $Vendors;
}

    public function LoadCusPagination(){
        //$Vendors=Customer::all();
        $Vendors=Customer::paginate(5);
        return $Vendors;
}

    public function Search(Request $request){
        $input = $request->all();
        //$search = VendorModel::find($input['Search']);
        $s= $input['Search'];
        $search = DB::table('customers')
                ->where('Customer', 'like', "%{$s}%")
                ->paginate(5);
        //dd($input);
        return $search;
    }
}
