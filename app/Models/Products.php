<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
    use HasFactory;


    public function customers()
    {
        return $this->belongsToMany(User::class, 'customers_categories_subcategories');
    }


    // customers category
    public function get_furnace_categories()
    {
        return DB::table('furnace_categories')->get();
    }

    public function get_customer_category_by_id($id)
    {
        return DB::table('furnace_categories')->where('id', $id)->first();
    }

    //customers subcategory

    public function get_customer_subcategory_by_id($id)
    {
        if (is_numeric($id))
            return DB::table('customer_subcategory')->where('id', $id)->first();

        return false;
    }

    public function get_subcategory_by_category_id($category_id)
    {
        return DB::table('customer_subcategory')->where('category_id', $category_id)->get();
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
        DB::table('customer_subcategory')->where('id', $id)->delete();
    }

    // customer_category_sbcategory ->money to money
    public function set_customer_categories_and_subcategories($customer_id, $categories_id, $subcategories_id)
    {

        if ($categories_id) {
            foreach ($categories_id as $category_id) {
                DB::insert("INSERT INTO customers_id_categories (customer_id, category_id) VALUES ($customer_id, $category_id)");

                if ($subcategories_id) {
                    foreach ($subcategories_id as $subcategory_id) {
                        $subcategory = $this->get_customer_subcategory_by_id($subcategory_id);
                        if ($subcategory->category_id == $category_id) {
                            DB::insert("INSERT INTO customer_category_id_subcategories (customer_id, category_id, subcategory_id) VALUES ($customer_id, $category_id, $subcategory_id)");
                        }
                    }
                }
            }
        }

        return true;
    }


    public function update_customer_categories_and_subcategories($customer_id, $categories_id, $subcategories_id)
    {
        DB::table('customers_id_categories')->where('customer_id', $customer_id)->delete();
        DB::table('customer_category_id_subcategories')->where('customer_id', $customer_id)->delete();

        foreach ($categories_id as $category_id) {
            DB::insert(
                'insert into customers_id_categories (customer_id, category_id) values (?, ?)',
                [$customer_id, $category_id]
            );
            if ($subcategories_id) {
                foreach ($subcategories_id as $subcategory_id) {
                    $subcategory = $this->get_customer_subcategory_by_id($subcategory_id);
                    if ($subcategory->category_id == $category_id) {
                        DB::insert(
                            'insert into customer_category_id_subcategories (customer_id, category_id, subcategory_id) values (?, ?, ?)',
                            [$customer_id, $category_id, $subcategory_id]
                        );
                    }
                }
            }
        }
    }
}
