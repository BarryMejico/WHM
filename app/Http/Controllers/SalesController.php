<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;
use App\SalesDetails;
use App\StocksList;
use App\payment;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function SaveInvoice(request $REQUEST){
        $input = $REQUEST->all();
        //dd($input);
        $SalesCode=Ucode();
        $UserIn=getUser()->id;

        $REQUEST->validate([
        'PO_total'=>'required',
        'Ship_to'=>'required',
        
        ]);
        //saving to list of JO
        $PO = sales::updateOrCreate(['invoice'=> $input['PO']],[
        'invoice'=> $SalesCode,
        'Total_Amount'=>$input['PO_total'],
        'Created_by'=>$UserIn,
        'Status'=>$input['Status'],
        'Reviewed_by'=>'',
        'Ccode'=>$input['Ship_to'],
        
        ]);
        $countarray = count($input['po_items'])-1;
        //dd($input['po_items']);
        
        DB::table('sales_details')->where('invoice',$input['PO'])->delete();

            for($i=0;$i<=$countarray;$i++){          
                     $newData = SalesDetails::updateOrCreate([
                        'Icode' => $input['po_items'][$i]['Icode'],
                        'invoice' => $input['PO']
                     ],[
                    'invoice' => $SalesCode,
                    'Icode' => $input['po_items'][$i]['Icode'],//                 "Icode" => "cp123"
                    'Qty' => $input['po_items'][$i]['Qty'], //                 "Qty" => 1
                    'UnitCost' => $input['po_items'][$i]['UnitCost'],//                 "UnitCost" => "500"
                    'description' => $input['po_items'][$i]['description'], //                 "idescription" => "123"
                    'Remarks' => $input['po_items'][$i]['Remarks'],  //                 "Remarks" => "asd"
                    'DeviceStatus' => $input['po_items'][$i]['status'],       //                 "status" => null
                    'Repairedby' => $input['po_items'][$i]['RepairedbyCode'],   //                 "Repairedby" => "Employee - 001"
        ]);
        
                    $newData->save();
                   
                } 

                //saving payment
                $payment=payment::updateOrCreate([
                    'invoice'=>$SalesCode,
                    'payment'=>$input['payment'],
                    'Balance'=>$input['Balance'],
                ]);
                $payment->save();
        $PO->save();


    }

    public function LoadInvoive(){
        //$invoice= Sales::all()->paginate(2);
        $invoice= Sales::paginate(3);
        return $invoice;
    }

    public function ApprovedInvoice(request $REQUEST){
        $input = $REQUEST->all();
        $UserIn=getUser()->id;
        //dd($REQUEST['params']['invoice']);
        $invoiceDetails=DB::table('sales_details')
        ->where('invoice', [$REQUEST['params']['invoice']])
        ->get();
        //dd($invoiceDetails);
        $countarray=count($invoiceDetails)-1;
        //dd($countarray);

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

    public function SearchTrans(Request $request){
        $search = DB::table('sales_details')
        ->join('sales', 'sales.invoice', '=', 'sales_details.invoice')
        ->join('employees', 'employees.Ecode', '=', 'sales_details.Repairedby')
        ->join('cusstomer__devices', 'cusstomer__devices.Code', '=', 'sales_details.Icode')
        ->join('users', 'users.id', '=', 'sales.Created_by')
        ->join('payments', 'payments.invoice', '=', 'sales_details.invoice')
        ->join('customers', 'customers.Ccode', '=', 'sales.Ccode')
        
        ->where('sales.Status', 'like', "%{$request['Status']}%")
        ->where('sales.Ccode', 'like', "%{$request['Ccode']}%")
        ->where('sales.Created_by', 'like', "%{$request['Createdby']}%")
        ->where('sales_details.Icode', 'like', "%{$request['Icode']}%")
        ->where('sales_details.Repairedby', 'like', "%{$request['RepairedBy']}%")
        ->where('sales_details.DeviceStatus', 'like', "%{$request['DeviceStatus']}%")
        ->where('cusstomer__devices.Model', 'like', "%{$request['model']}%")
        ->where('cusstomer__devices.DeciveName', 'like', "%{$request['DeviceName']}%")

        ->select('sales.updated_at',
                    'customers.Customer',
                    'sales.Total_Amount',
                    'payments.payment',
                    'payments.Balance',
                    'users.name',
                    'sales.Status',
                    'cusstomer__devices.Code',
                    'cusstomer__devices.DeciveName',
                    'cusstomer__devices.Model',
                    'employees.Employee',
                    'sales_details.Remarks',
                    'sales_details.updated_at',
                    'sales_details.description',
                    'sales_details.DeviceStatus',
                    'sales.invoice'
)
        ->get();
        return $search;
    }
}
