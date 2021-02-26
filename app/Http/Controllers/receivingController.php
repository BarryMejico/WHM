<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReceivingDetails; 
use App\ReceivingList;
use App\StocksList;
use App\po_list;
use Illuminate\Support\Facades\DB;

class receivingController extends Controller
{
    public function store(Request $request) 
    {
        $input = $request->all();
        //dd($input);
        
        $UserIn=getUser()->id;
        $countR=ReceivingList::count();
        $ReceivingCode=Ucode() . "-" . strval($countR);

        $request->validate([
        'PO'=>'required',
        'PO_total'=>'required',
        ]);

        $PO = ReceivingList::updateOrCreate(['PO'=> $input['PO']],[
        'PO'=> $input['PO'],
        'Total_Amount'=>$input['PO_total'],
        'Created_by'=>$UserIn,
        'Status'=>'Open',
        'Reviewed_by'=>'test1',
        'ReceivingCode'=>$ReceivingCode,
        ]);
        
        $countarray = count($input['po_items'])-1;
        //dd($countarray);
        
        DB::table('receiving_details')->where('PO',$input['PO'])->delete();

            for($i=0;$i<=$countarray;$i++){          
                     $newData = ReceivingDetails::updateOrCreate([
                        'Icode' => $input['po_items'][$i]['Icode'],
                        'PO' => $input['PO']
                     ],[
                    'Icode' => $input['po_items'][$i]['Icode'],
                    'Qty' => $input['po_items'][$i]['Qty'],
                    'UnitCost' => '',
                    'PO' => $input['PO'],
                    'ReceivingCode'=>$ReceivingCode,

        ]);
        $item=DB::table('stocks_lists')
        ->where('Icode', [$input['po_items'][$i]['Icode']])
        ->get();

        $countS=$item->count();
        //DB::table('stocks_lists')->where('Icode',$input['po_items'][$i]['Icode'])->count();
        //dd($item[0]->Qty);

                        if ($countS<=0){
                            $newQTY=
        $updateStocks=StocksList::updateOrCreate([
            'Icode' => $input['po_items'][$i]['Icode'],
            'Qty' => $input['po_items'][$i]['Qty'],
            'UnitCost'=>'',
            'Location'=>'',
        ]);

                        }else{
                            $newCalQty=$item[0]->Qty + $input['po_items'][$i]['Qty'];
                            $updateStocks=StocksList::updateOrCreate(['Icode' => $input['po_items'][$i]['Icode']],[
                                'Qty' => $newCalQty,
                                'UnitCost'=>'',
                                'Location'=>'',
                            ]);

                        }
        
                    $newData->save();
                    $updateStocks->save();
                   
                } $PO->save();

                $status = DB::table('po_lists')
                ->where('PO',$input['PO'])
                ->update(['Status'=>"Done"],['Reviewed_by'=>$UserIn]);

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

public function item(Request $request){
    $input = $request->all();
    //dd($input);
    $stocks = StocksList::where('ICode',$input['Code'])->get();
    return $stocks;
}

public function stocks(){
    $stocks= StocksList::all();
    return $stocks;
}


}
