<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\User;

class CompanyController extends Controller
{
    public function SaveCompany(Request $res){
        // dd($res);
        $res->validate([
            'CompanyName' => 'required',
            'CompanyAddress' => 'required',
            'CompanyOwner' => 'required',
        ]);

        // dd($res->c);
        $input=$res->all();
        // dd($input);
        $Code=Ucode();

        $company = Company::create([
            'CoCode'=>$Code,
            'CompanyName'=>$input['CompanyName'],
            'CompanyAddress'=>$input['CompanyAddress'],
            'CompanyOwner' =>$input['CompanyOwner'],
            ]);
            $company->save();

            $UserIn=getUser()->id;
       
            $User = User::where('id',$UserIn)
            ->update([
               'CoCode'=> $Code,
            ]);
    }
}
