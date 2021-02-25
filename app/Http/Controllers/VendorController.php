<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VendorModel;
use Illuminate\Support\Facades\App;
use App\Helper\Ucode;
use App\Ucode\Ucode as UcodeUcode;
use Illuminate\Support\Facades\DB;
use App\Rules\inUseData;

class VendorController extends Controller
{
    public function index(){
        $Vendors=VendorModel::all();
        //$Vendors=VendorModel::paginate(5);
        return $Vendors;
    }

    public function indexPagination(){
        //$Vendors=VendorModel::all();
        $Vendors=VendorModel::paginate(5);
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

        $customer = VendorModel::where('Vcode',$input['ids'])
        ->update([
           'Vendor'=> $input['Name'],
           'Number'=> $input['Number'],
           'Address'=> $input['Address'],
        ]);
        
    }

    public function Delete(Request $request){  
        $input = $request->all();

        $request->validate([
            'Vcode'=>['required', new inUseData],
        ]);
        $customer = VendorModel::where('Vcode',$input['Vcode'])->delete();
    }   
                                      
    public function Search(Request $request){
        $input = $request->all();
        //$search = VendorModel::find($input['Search']);
        $s= $input['Search'];
        $search = DB::table('vendor_models')
                ->where('Vendor', 'like', "%{$s}%")
                ->get();
        
        //dd($input);
        return $search;
    }
}
