<?php

namespace App\Http\Controllers;
use App\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function store(Request $request){  
        $input = $request->all();
        //dd($input);      
        $request->validate([
            'Name_'=>'required', 
        ]);

       
        $Code=Ucode();
       
        $Vendor = Employee::Create([
            'Employee'=> $input['Name_'], 
            'Ecode'=>$Code,
        ]);
        $Vendor->save();
    }

    public function LoadEmp(){
        $Vendors=Employee::all();
        //$Vendors=Customer::paginate(5);
        return $Vendors;
}
}
