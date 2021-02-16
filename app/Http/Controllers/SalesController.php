<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;
use App\SalesDetails;
use App\StocksList;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function SaveInvoice(request $REQUEST){
        $input = $REQUEST->all();
        //dd($input);

        $UserIn=getUser()->id;
        $REQUEST->validate([
        'PO'=>'required',
        'PO_total'=>'required',
        'Ship_to'=>'required',
        ]);

        $PO = sales::updateOrCreate(['invoice'=> $input['PO']],[
        'invoice'=> $input['PO'],
        'Total_Amount'=>$input['PO_total'],
        'Created_by'=>$UserIn,
        'Status'=>'Open',
        'Reviewed_by'=>'test1',
        'Ccode'=>$input['Ship_to'],
        ]);
        $countarray = count($input['po_items'])-1;
        //dd($countarray);
        
        DB::table('sales_details')->where('invoice',$input['PO'])->delete();

            for($i=0;$i<=$countarray;$i++){          
                     $newData = SalesDetails::updateOrCreate([
                        'Icode' => $input['po_items'][$i]['Icode'],
                        'invoice' => $input['PO']
                     ],[
                    'Icode' => $input['po_items'][$i]['Icode'],
                    'Qty' => $input['po_items'][$i]['Qty'],
                    'UnitCost' => $input['po_items'][$i]['UnitCost'],
                    'invoice' => $input['PO'],
                    'description' => $input['po_items'][$i]['idescription'],
                    'Remarks' => ""
        ]);
        
                    $newData->save();
                   
                } 
        $PO->save();


    }

    public function LoadInvoive(){
        $invoice= Sales::all();
        return $invoice;
    }

    public function ApprovedInvoice(request $REQUEST){
        $input = $REQUEST->all();
        $UserIn=getUser()->id;
        //dd($REQUEST['params']['invoice']);
        $invoiceDetails=DB::table('sales_details')
        ->where('invoice', [$REQUEST['params']['invoice']])
        ->get();
        
        $countarray=count($invoiceDetails)-1;
        
        for($i=0;$i<=$countarray;$i++){
            

            $item=DB::table('stocks_lists')
        ->where('Icode', [$invoiceDetails[$i]->Icode])
        ->get();
        //dd($invoiceDetails[$i]->Qty);
            $NewQty=$item[0]->Qty-$invoiceDetails[$i]->Qty;
            
            $updateStocks=StocksList::updateOrCreate(['Icode' => $invoiceDetails[$i]->Icode],[
                'Qty' => $NewQty,
                
            ]);
            $updateStocks->save();
        }

        $PO = sales::updateOrCreate(['invoice'=> $REQUEST['params']['invoice']],[
            'Status'=>'Approved',
            'Reviewed_by'=>$UserIn,
            ]);
    }

    public function GetInvoice(Request $request){
        $PO= DB::connection('mysql')->select("SELECT * FROM `sales_details` where invoice=?",[$request['PO']]);
        //dd($PO);
        return $PO;
    }

    public function GetInvoiceHead(Request $request){
        $PO= DB::connection('mysql')->select("SELECT * FROM `sales` where invoice=?",[$request['PO']]);
        //dd($PO);
        return $PO;
    }

    public function history(Request $request){
        $PO= DB::connection('mysql')->select("SELECT * FROM `sales_details` where Icode=?",[$request['Icode']]);
        //dd($PO);
        return $PO;
    }

    public function Saleshistory(Request $request){
        $PO= DB::connection('mysql')->select("SELECT * FROM `sales` WHERE Status=?",[$request['Status']]);
        //dd($PO);
        return $PO;
    }
}
