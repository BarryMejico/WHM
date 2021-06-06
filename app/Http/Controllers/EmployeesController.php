<?php

namespace App\Http\Controllers;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
{
    public function store(Request $request){  
        $input = $request->all();
        //dd($input);      
        $request->validate([
            'Name_'=>'required', 
        ]);

       
        $Code=Ucode();
        $CoCode=getUser()->CoCode;
       
        $Vendor = Employee::Create([
            'Employee'=> $input['Name_'], 
            'Ecode'=>$Code,
            'CoCode'=>$CoCode,
            'Position'=>"Input position",
            'permCode'=>null,
        ]);
        $Vendor->save();
    }

    public function LoadEmp(){
        $Employee=Employee::paginate(5);
        return $Employee;
}

public function all_LoadEmp(){
    $Employee=DB::table('employees')
                ->leftJoin('users','users.id','=','employees.id')
                ->select('users.id',
                         'employees.Employee',
                         'employees.CoCode',
                         'users.permCode',
                         'employees.Position',
                )
                ->get();
    
    return $Employee;
}

public function Search(Request $request){
    $input = $request->all();
    //$search = VendorModel::find($input['Search']);
    $s= $input['Search'];
    $search = DB::table('employees')
            ->where('Employee', 'like', "%{$s}%")
            ->paginate(5);
    //dd($search);
    return $search;
}

public function storeinvited(){  
    $Code=Ucode();
    $CoCode=getUser()->CoCode;
    $Name_=getUser()->name;
    $id_=getUser()->id;
   
    $Vendor = Employee::Create([
        'Employee'=> $Name_, 
        'Ecode'=>$Code,
        'CoCode'=>$CoCode,
        'id'=>$id_,
        'Position'=>"Input position",
        'permCode'=>null,
    ]);
    $Vendor->save();
}
}
