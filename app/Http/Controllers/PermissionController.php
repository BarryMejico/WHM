<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\permission;
use App\permission_detail;

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
        $permission = permission_detail::Create([
            'permCode'=>$input['params']['perma'],
            'id'=>$input['params']['id'],
            'CoCode'=>null,
            ]);
            $permission->save();
            return $input;
    }
}
