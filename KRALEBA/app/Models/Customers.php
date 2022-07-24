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

    public function get_customer_by_id($id)
    {
        if (is_numeric($id)) {
            return DB::table('customers')->where('id', $id)->first();
        }
    }

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

    public function get_customer_and_categories_by_id($id)
    {

        if (!$id) {
            return false;
        }

        $query = "SELECT category_id FROM customers_categories_subcategories WHERE customer_id = {$id}";
        $categories_obj = DB::select($query);

        $i = 0;
        foreach ($categories_obj as $unic_categories) {

            $categories_obj[$unic_categories->category_id] = $unic_categories->category_id;
            $i++;
        }

        $categories = array();
        $product = new Products();
        foreach ($categories_obj as $category) {

            if (!is_object($category)) {
                $categories[$category] = (array)$product->get_customer_category_by_id($category);
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
            if ($subcateogry) {
                $subcategories[$subcateogry[0]->subcategory_id] = array(
                    'id' => $subcateogry[0]->subcategory_id,
                    'name' => $subcateogry[0]->name,
                    'category_id' => $customer->category_id,
                );
            }
            $i++;
        }
        if ($customers) {
            $customer = (array)$customers[0];
        }
        $customer['subcategory_id'] = $subcategories;
        $customer['category_id'] = $categories;

        return $customer;

    }

    /** Delete customer by id and clear db.
     * @param $id
     * @return
     */
    public function delete_customer($id)
    {
        if (is_numeric($id)) {
            DB::table('customers')->where('id', $id)->delete();
            DB::table('customers_categories_subcategories')->where('customer_id', $id)->delete();
            return true;
        }
        return false;
    }


    public function get_customers_after_filterOLD($customer_type, $category_id, $subcategory)
    {

        if ($customer_type && !$category_id && !$subcategory) {
            return DB::table('customers')->where('type', $customer_type)->get();
        }

        $query = " SELECT * " .
            " FROM customers_categories_subcategories " .
            " WHERE ";
        $i = 0;

        if ($customer_type) {
            $query .= 'customer_type = ' . "'$customer_type'";
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

        $results = DB::select($query);
        $customers = array();
        $i = 0;

        foreach ($results as $result) {
            $customers[$i] = $this->get_customer_by_id($result->customer_id);
            $i++;
        }
        return $customers;

    }

    public function get_customers_after_filter($customer_name, $customer_type, $category_id, $subcategory_id)
    {
        $query_format = '';
        if ($customer_name) {
            $query_format = " WHERE c.name = '{$customer_name}'";
        }

        if ($query_format && $customer_type) {
            $query_format = " AND c.type = '{$customer_type}'";
        } else if ($customer_type) {
            $query_format = " WHERE c.type = '{$customer_type}'";
        }

        if ($query_format && $category_id) {
            $query_format = " AND cs.customer_id = '{$category_id}'";
        } else if ($category_id) {
            $query_format = " WHERE cs.customer_id = '{$category_id}'";
        }

        if ($query_format && $subcategory_id) {
            $query_format = " AND cs.subcategory_id = '{$subcategory_id}'";
        } else if ($subcategory_id) {
            $query_format = " WHERE cs.subcategory_id = '{$subcategory_id}'";
        }

        $query = "SELECT * FROM customers_categories_subcategories AS cs
            JOIN  customers AS c
            ON c.id = cs.customer_id {$query_format}";

        $result = DB::select($query);
//        dd(DB::select($query));
        return $result;
    }

    public function get_customer_name_by_search($data)
    {
        $query = "SELECT name, id FROM customers WHERE name LIKE '%{$data}%' OR uniqueCode LIKE '%{$data}%' ";
        $results = DB::select($query);

//        dd($results);
        return $results;

    }

}


