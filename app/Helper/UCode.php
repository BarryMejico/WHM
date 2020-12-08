<?php 

if (!function_exists('custom')) {
    
    function Ucode() {
        $d = date("yy-m-dH");
        $code = $d;
        return $code;
}

function getUser(){
    return auth()->user();
}

function PO_details(){
$PO_detail=array(
        "icode",
        "idescription",
        "iunit",
        "Qty",
        "Ucost",
        "Tcost"
);

}



 }

