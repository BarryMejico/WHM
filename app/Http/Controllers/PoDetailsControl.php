<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\poDetails; 
use App\po_list;
use Illuminate\Support\Facades\DB;


class PoDetailsControl extends Controller
{
    public function store(Request $request) 
    {
        $input = $request->all();
        //dd($input);
        $UserIn=getUser()->id;
        

        $request->validate([
        'PO'=>'required',
        'PO_total'=>'required',
        ]);

        $PO = po_list::updateOrCreate(['PO'=> $input['PO']],[
            'id'=> null,
            'PO'=> $input['PO'],
        'Total_Amount'=>$input['PO_total'],
        'Created_by'=>$UserIn,
        'Status'=>$input['status'],
        'Reviewed_by'=>null,
        'Vendor'=>$input['Vendor'],
        'Ship_to'=>$input['Ship_to'],
        ]);
        
        $countarray = count($input['po_items'])-1;
        //dd($countarray);
        
        DB::table('po_details')->where('PO',$input['PO'])->delete();

            for($i=0;$i<=$countarray;$i++){          
                     $newData = poDetails::updateOrCreate([
                        'Icode' => $input['po_items'][$i]['Icode'],
                        'PO' => $input['PO']
                     ],[
                    'Icode' => $input['po_items'][$i]['Icode'],
                    'Qty' => $input['po_items'][$i]['Qty'],
                    'UnitCost' => $input['po_items'][$i]['UnitCost'],
                    'PO' => $input['PO']
        ]);
        
                    $newData->save();
                   
                } $PO->save();
                
                //Save Audit

}
public function LoadPo(){
    $po= po_list::all();
    return $po;
}

public function GetPo(Request $request){
    $PO= DB::connection('mysql')->select("SELECT * FROM `po_details` where PO=?",[$request['PO']]);
    //dd($PO);
    return $PO;
}
public function GetPoHead(Request $request){
    $PO= DB::connection('mysql')->select("SELECT * FROM `po_lists` where PO=?",[$request['PO']]);
    //dd($PO);
    return $PO;
}

public function DeleteItem(Request $request){
        $input = $request->all();
}

public function ChangeStatus(Request $request){
    $input = $request->all();
        //dd($input['PO']);
        $UserIn=getUser()->id;
        
        $request->validate([
        'PO'=>'required',
        'Status'=>'required',
        ]);

        $PO = DB::table('po_lists')
        ->where('PO',$input['PO'])
        ->update(['Status'=>$input['Status']],['Reviewed_by'=>$UserIn]);
        
}
}