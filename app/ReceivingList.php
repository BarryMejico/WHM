<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceivingList extends Model
{
    protected $fillable = [
        'ReceivingCode',
        'PO',
        'Total_Amount',
        'Created_by',
        'Status',
        'Reviewed_by',
    ];
}
