<?php

namespace App\Models;

use App\Helpers\CustomerHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customers extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'note', 'uniqueCode', 'type', 'address', 'zipCode', 'city', 'category_id', 'subcategory_id', 'country',
        'cif', 'ocr', 'iban', 'swift', 'bank', 'contact', 'phone', 'phone2', 'email', 'www'
    ];

    /**
     * Get all customers with subcategory name
     * @return $reslut
     */

    public static function get_customers()
    {

        $results = DB::table('customers')
            ->orderBy('name')
            ->get();
        if ($results->toArray()) {
            return $results;
        }
        return false;
    }

    public function get_customer_and_categoryes_by_id($id)
    {

        $query = "SELECT category_id FROM customers_categories_subcategories WHERE customer_id = {$id}";
        $categories_obj = DB::select($query);

        $i = 0;
        foreach ($categories_obj as $unic_categories) {

            $categories_obj[$unic_categories->category_id] = $unic_categories->category_id;
            $i++;
        }

        $categories = array();
        foreach ($categories_obj as $category) {

            if (!is_object($category)) {
                $categories[$category] = $category;
            }
        }

        $subcategories = array();

        $query = "SELECT *
                FROM customers
                JOIN customers_categories_subcategories
                ON customers.id = customers_categories_subcategories.customer_id
                WHERE customers.id=" . $id . ";";

        $customers = DB::select($query);

        $i = 0;
        foreach ($customers as $customer) {
            $subcateogry = DB::table('customer_subcategory')->where('subcategory_id', $customer->subcategory_id)->get()->toArray();
            $subcategories[$subcateogry[0]->subcategory_id] = $subcateogry[0]->subcategory_id;
            $i++;
        }
        $customer = (array)$customers[0];
        $customer['subcategory_id'] = $subcategories;
        $customer['category_id'] = $categories;


        return $customer;

    }

    /** Delete customer by id and clear db.
     * @param $id
     * @return
     */
    public
    function delete_customer($id)
    {
        if (is_numeric($id)) {
            DB::table('customers')->where('id', $id)->delete();
            DB::table('customers_categories_subcategories')->where('customer_id', $id)->delete();
            return true;
        }
        return false;
    }

    public
    function get_customers_after_filter_OLD($type, $category_id, $subcategory)
    {

        $query = " SELECT * " .
            " FROM customers " .
            " WHERE ";
        $i = 0;

        if ($type) {
            $query .= 'type = ' . "'$type'";
            $i++;
        }

        if ($category_id) {
            if ($i == 0) {
                $query .= 'category_id = ' . "'$category_id'";
                $i++;
            } else {
                $query .= "AND " . 'category_id = ' . "'$category_id'";
                $i++;
            }
        }

        if ($subcategory) {
            if ($i == 0) {
                $query .= 'subcategory_id = ' . "'$subcategory'";
                $i++;
            } else {
                $query .= "AND " . 'subcategory_id = ' . "'$subcategory'";
                $i++;
            }
        }

        if ($i == 0) {
            return false;
        }

        $query .= ' ORDER BY name ASC';

        $results = DB::select($query);

        return $results;

    }


    function get_customers_after_filter($type, $category_id, $subcategory)
    {

    }


}


