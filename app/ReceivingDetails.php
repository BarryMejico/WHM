<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceivingDetails extends Model
{
    protected $fillable = [
        'Icode',
        'Qty',
        'UnitCost',
        'ReceivingCode', 
        'PO',
    ];
}
