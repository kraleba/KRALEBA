<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
    use HasFactory;

// customers category
    public function get_furnace_categories()
    {
        return DB::table('furnace_categories')->get();

    }

    public function get_customer_category_by_id($id)
    {
        return DB::table('furnace_categories')->where('category_id', $id)->first();

    }

//customers subcategory

    public function get_customer_subcategory_by_id($id)
    {
        if (is_numeric($id))
            return DB::table('customer_subcategory')->where('subcategory_id', $id)->first();

        return false;

    }

    public function get_subcategory_for_customer_category()
    {
        return DB::table('customer_subcategory')->get();
    }

    public function find_subcategory_by_label($label)
    {
        return DB::table('customer_subcategory')->where('name', $label)->first();

    }

    public function set_customers_subcategory($data)
    {
        DB::table('customer_subcategory')->insert($data);
    }

    public function delete_subcategory_by($id)
    {
        DB::table('customer_subcategory')->where('subcategory_id', $id)->delete();

    }

}
