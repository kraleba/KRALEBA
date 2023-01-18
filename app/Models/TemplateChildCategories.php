<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateChildCategories extends Model
{
    use HasFactory;
    protected $table = 'template_child_categories';
    protected $fillable = [
        'template_child_id',
        'category_id',
        'customer_id',
        'custom_code',
        'ware_id',
        'amount'
    ];

    public function child()
    {
        return $this->belongsTo(TemplateChild::class, 'child_id');
    }
}
