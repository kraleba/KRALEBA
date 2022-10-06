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
        'name', 'note', 'unique_code', 'type', 'address', 'zip_code', 'city', 'category_id', 'subcategory_id', 'country',
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

    public function get_customer_and_categories_by_id_old($id)
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

    public function get_customer_and_categories_by_id($id)
    {

        if (!$id) {
            return false;
        }

        $query = "SELECT
                c.customer_id,
                s.category_id,
                cc.name as category_name,
                s.subcategory_id,
                cs.name
            FROM customers_id_categories AS c
            JOIN customer_category_id_subcategories AS s
                ON c.category_id = s.category_id
            JOIN customer_subcategory AS cs
                ON s.subcategory_id = cs.id
            JOIN furnace_categories AS cc
                ON cc.id = c.category_id
            WHERE c.customer_id = {$id}
                AND s.category_id = c.category_id
                AND s.customer_id = {$id}";

        $categories_obj = DB::select($query);

        $textile = DB::select("
                        SELECT
                            c.category_id,
                            c.customer_id,
                            f.name as category_name
                        FROM customers_id_categories AS c
                        JOIN furnace_categories AS f
                            ON f.id = c.category_id
                        WHERE c.customer_id = {$id}
                            AND c.category_id = 8");

        $customer = $this->get_customer_by_id($id);

        if ($textile) {
            $textile[0]->name = $textile[0]->category_name;
            $textile[0]->subcategory_id = ' ';
            $categories_obj[-1] = $textile[0];
        }

        $customer->categories = $categories_obj;

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
            DB::table('customers_id_categories')->where('customer_id', $id)->delete();
            DB::table('customer_category_id_subcategories')->where('customer_id', $id)->delete();
            DB::table('bills')->where('customer_id', $id)->delete();
            DB::table('customer_wares')->where('customer_id', $id)->delete();
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

    public function get_customers_after_filter($customer_name, $customer_type, $category_id)
    {

        $query = 'SELECT c.* FROM customers AS c';

        if ($customer_type == 'provider' || $category_id) {
            $query .= ' JOIN customers_id_categories AS cs
                ON c.id = cs.customer_id';
        }

        if ($customer_name) {
            $query .= " WHERE c.name LIKE '%{$customer_name}%'";
        }

        if ($customer_name && $customer_type) {
            $query .= " AND c.type = '{$customer_type}'";
        } else if ($customer_type) {
            $query .= " WHERE c.type = '{$customer_type}'";
        }

        if (($customer_name || $customer_type) && $category_id) {
            $query .= " AND cs.category_id = '{$category_id}'";
        } else if ($category_id) {
            $query .= " WHERE cs.category_id = '{$category_id}'";
        }

        $query .= ' ORDER BY c.name';
        $results = DB::select($query);

        $customers = array();

        foreach ($results as $result) {
            if ($result->type == 'provider') {
                $result->type = 'Furnizor';
            }

            if ($result->type == 'customer') {
                $result->type = 'Beneficiar';
            }
            $customers[$result->id] = $result;
        }

        return $customers;
    }

    /*search just providers*/
    public function get_customer_name_by_search($data, $category_id, $custom_search = null)
    {

        if ($category_id) {
            $and_or = "AND cc.category_id = {$category_id}";
        } else {

            $and_or = "OR c.unique_code LIKE '%{$data}%'";
        }

        $query = "
                SELECT c.name, c.id
                FROM customers AS c
                ";

        if ($category_id) {
            $query .= "
                LEFT JOIN customers_id_categories AS cc
                ON c.id = cc.customer_id
                WHERE c.name LIKE '%{$data}%'
                AND c.type = 'provider'
                 {$and_or}
                GROUP BY c.name, c.id
                ORDER BY c.name
                ";
        } else {
            $query .= "WHERE c.name LIKE '%{$data}%'";
        }

        if ($custom_search) {
            $employees = DB::select($query);
            $response = array();
            foreach ($employees as $employee) {
                $response[] = array(
                    "id" => $employee->id,
                    "text" => $employee->name,
                    "category_id" => $category_id,
                );
            }

            return $response;
        }

        return DB::select($query);

    }

}


