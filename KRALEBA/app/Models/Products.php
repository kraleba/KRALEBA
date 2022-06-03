<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
    use HasFactory;


    public function get_furnace_categories()
    {
        return DB::table('furnace_categories')->get();

    }

    public function get_subcategory_for_customer_category()
    {
        return DB::table('customer_subcategory')->get();

    }

}
