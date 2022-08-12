<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateChildCategories extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_child_id',
        'category_id',
        'customer_id',
        'custom_code',
        'bill_date',
        'bill_number',
        'amount'
    ];
}
