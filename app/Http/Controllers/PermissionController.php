<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\permission;
use App\permission_detail;
use App\User;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function addpermision(){
        $Code=Ucode();
        $permission = permission::Create([
            'permCode'=>$Code,
            'Description'=>$Code,
            ]);
            $permission->save();
            return $Code;
    }

    public function addpermisionDetails(Request $request){
        $input = $request->all();
        $UserCoCode=getUser()->CoCode;
        
        $D = permission_detail::Create([
            'permCode'=>$input['params']['perma'],
            'id'=>$input['params']['id'],
            'CoCode'=> $UserCoCode,
            ]);
            $D->save();
            return $input;
    }

    public function activePermaCode(Request $request){
        $input = $request->all();
        
        $PO = DB::table('users')
        ->where('id',$input['params']['id'])
        ->update(['permCode'=>$input['params']['permCode']]);
    }
}
