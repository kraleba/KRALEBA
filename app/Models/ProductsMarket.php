<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsMarket extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'market_category',
        'order_date',
        'delivery_date',
        'production_batch_code',
        'selected_products',
        'product_name',
        'template_id',
        'manufactured_products',

    ];

}
