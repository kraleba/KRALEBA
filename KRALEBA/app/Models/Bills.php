<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    use HasFactory;

    protected $fillable = [
        'custumer_id', 'unique_code', 'type', 'bill_date', 'bill_number', 'currency', 'exchange', 'TVA', 'item',
         'specify_id',
    ];
}
