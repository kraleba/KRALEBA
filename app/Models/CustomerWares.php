<?php

namespace App\Models;

use Doctrine\DBAL\Query;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class CustomerWares extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name', 'custom_code', 'composition', 'material', 'structure', 'design', 'weaving', 'color', 'finishing', 'perceived_weight',
        'softness', 'look', 'grounds', 'weight_in_g_m2', 'width', 'warp_th_per_cm', 'warp_th_per_yarn_ne', 'weft_p_per_cm', 'origin', 'date',
        'rating', 'description', 'um', 'amount', 'coin', 'customer_id', 'bill_id', 'category_id', 'subcategory_id', 'status', 'price'
    ];


    public function create_wares_from_bill($bill_id, $form_data)
    {

        if (!$bill_id || !$form_data) {
            return false;
        }

        $i = 1;
        foreach ($form_data as $form) {
            if (array_key_exists('categories_id' . $i, $form_data))
                $form_data['category_id'][$i - 1] = $form_data['categories_id' . $i];

            if (array_key_exists('subcategories_id' . $i, $form_data))
                $form_data['subcategory_id'][$i - 1] = $form_data['subcategories_id' . $i];

            unset($form_data['categories_id' . $i]);
            unset($form_data['subcategories_id' . $i]);
            ++$i;
        }

        $index = 0;
        /*count number of parent fields*/
        foreach ($form_data as $form_values) {
            if (!is_array($form_values)) {
                $index++;
            }
        }
        $wares = [];
        $rows = array_keys($form_data);
        foreach ($form_data as $form_values) {
            // dump($form_values);
            if (is_array($form_values)) {
                $i = 0;
                foreach ($form_values as $value) {
                    $wares[$i][$rows[$index]] = $value;
                    $i++;
                }
                ++$index;
            }
        }
        // create weae
        foreach ($wares as $ware) {
            $ware['customer_id'] = $form_data['customer_id'];
            $ware['bill_id'] = $bill_id;
            CustomerWares::create($ware);
        }
        // dd($form_data);
        $product = new Products();
        // update categories and subcategories in customer
        if ($form_data['customer_id']) {
            $product->update_customer_categories_and_subcategories(
                $form_data['customer_id'],
                $form_data['category_id'],
                $form_data['subcategory_id'],
                true
            );
        }
    }

    public function get_wares_by_customer_id($customer_id = null, $status = null)
    {
        if (!$status) {
            $status = 0;
        }

        if ($customer_id) {
            $query = "SELECT *
            FROM customers AS c
            LEFT JOIN customer_wares AS w
            ON c.id = w.customer_id
            WHERE w.customer_id = {$customer_id}
            AND w.status = {$status}";
        } else {
            $status = 1;
            $query = "SELECT *
            FROM customers AS c
            LEFT JOIN customer_wares AS w
            ON c.id = w.customer_id
            WHERE w.status = {$status}";
        }

        return DB::select($query);
    }

    public function get_wares_id_from_customer_id($customer_id)
    {

        $query = "SELECT customer_wares.id, customer_wares.product_name
            FROM customer_wares
            LEFT JOIN customers
            ON customers.id = customer_wares.customer_id
            WHERE customer_wares.customer_id = {$customer_id}
            AND customer_wares.status = 0";

        return DB::select($query);
    }

    public function delete_ware_by_id($ware_id)
    {
        if (is_numeric($ware_id)) {
            DB::table('customer_wares')->where('id', $ware_id)->delete();
            return true;
        }
        return false;
    }

    public function get_ware_by_id($ware_id)
    {
        if (is_numeric($ware_id)) {
            return DB::table('customer_wares')->where('id', $ware_id)->first();
        }
        return false;
    }

    public function ware_update($data, $id)
    {
        unset($data['_token']);
        unset($data['_method']);
        DB::table('customer_wares')->where('id', $id)
            ->update($data);
    }

    public function get_wares_by_filter($customer_name, $category, $subcategory)
    {
        $query = DB::table('customer_wares')
            ->select('*', 'customer_wares.id as id')
            ->join('customers', 'customers.id', '=', 'customer_wares.customer_id')
            ->join('bills', 'customer_wares.bill_id', 'bills.id');

        if ($customer_name) {
            $query = $query
                ->where('customers.name', 'LIKE', "%$customer_name%");
        }

        if ($category) {
            $query = $query->where('customer_wares.category_id', $category);
        }

        if ($subcategory) {

            $subcategory_id = DB::table('customer_subcategory')->select('id')->where('name', $subcategory )->first();
            if($subcategory_id) {
                $query = $query->where('customer_wares.subcategory_id', $subcategory_id->id);
            }

        }

        return $query
            ->where('customer_wares.category_id', '!=', 8)
            ->orderBy('customer_wares.product_name')
            ->get();
    }

    public function get_textiles_filters_suggestions($term, $row_name)
    {
        if (!$row_name || !$term) {
            return false;
        }

        $query = "SELECT {$row_name} FROM customer_wares WHERE {$row_name} LIKE '%{$term}%' GROUP BY {$row_name}";

        return DB::select($query);
    }

    public function get_wares_suggestions_for_customer($search, $row_name, $customer_id = null, $product_name_selected = null, $category_id = null)
    {
        if (!$row_name) {
            return false;
        }
        //dump($row_name);
        $dynamic_query = '';
        if ($customer_id) {
            $dynamic_query .= "AND customer_id = {$customer_id}";
        }

        if ($product_name_selected) {
            $dynamic_query .= " AND product_name = '{$product_name_selected}'";
        }

        if ($category_id) {
            $dynamic_query .= " AND category_id = '{$category_id}'";
        }

        $query = "SELECT {$row_name}, id
                FROM customer_wares
                WHERE {$row_name} LIKE '%{$search}%'
                {$dynamic_query}
                ORDER BY {$row_name}";

        $employees = DB::select($query);
        $response = array();

        foreach ($employees as $employee) {
            $response[] = array(
                "id" => $employee->id,
                "text" => $employee->$row_name
            );
        }
        return $response;
    }
    
}
