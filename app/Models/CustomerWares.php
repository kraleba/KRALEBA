<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class CustomerWares extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name', 'custom_code', 'composition', 'material', 'structure', 'design', 'weaving', 'color', 'finishing', 'perceived_weight',
        'softness', 'look', 'grounds', 'weight_in_g/m2', 'width', 'warp_th_per_cm', 'warp_th_per_yarn_ne', 'weft_p_per_cm', 'origin', 'date',
        'rating', 'description', 'um', 'amount', 'coin', 'customer_id', 'bill_id', 'category_id', 'subcategory_id', 'status', 'price'
    ];

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

    public function get_wares_by_filter($ware_type, $type, $category, $subcategory)
    {
        if (!$ware_type) {
            return false;
        }

        /*if category id is 8 */
        if ($ware_type == 'wares') {
            $textile = 8;
            $operator = '!= ';
        } else {
            $operator = "=";
            $textile = 8;
        }

        $query = "SELECT
                w.id,
                w.customer_id,
                w.product_name,
                w.custom_code,
                w.description,
                w.date,
                w.coin,
                w.um,
                w.amount
                FROM customer_wares AS w
                JOIN customers AS c
                ON w.customer_id = c.id
                WHERE w.category_id {$operator} '{$textile}'";

        if ($type) {
            $query .= " AND c.type = '{$type}'";
        }

        if ($type && $category) {
            $query .= " AND w.category_id = {$category}";
        }

        if ($type && $subcategory) {
            $query .= " AND w.subcategory_id = {$subcategory}";

        } else if ($subcategory) {
            $query .= " AND w.subcategory_id = {$subcategory}";
        }

        return DB::select($query);
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

    public
    function get_suggestions_for_textiles_filters($customer_name, $textiles_composition, $textiles_material, $textiles_design, $textiles_color, $textiles_structure, $textiles_weaving, $textiles_finishing, $textiles_rating)
    {
        $query_options = '';

        /* customer name */
        if ($customer_name) {
            $query_options = " WHERE c.name = '{$customer_name}'";
        }

        /* composition */
        if ($textiles_composition && $query_options) {
            $query_options = " AND w.composition = '{$textiles_composition}'";
        } else if ($textiles_composition) {
            $query_options = " WHERE w.composition = '{$textiles_composition}'";
        }

        //material
        if ($textiles_material && $query_options) {
            $query_options = " AND w.material = '{$textiles_material}'";
        } else if ($textiles_material) {
            $query_options = " WHERE w.material = '{$textiles_material}'";
        }

        //design
        if ($textiles_design && $query_options) {
            $query_options = " AND w.design = '{$textiles_design}'";
        } else if ($textiles_design) {
            $query_options = " WHERE w.design = '{$textiles_design}'";
        }

        //color
        if ($textiles_color && $query_options) {
            $query_options = " AND w.color = '{$textiles_color}'";
        } else if ($textiles_color) {
            $query_options = " WHERE w.color = '{$textiles_color}'";
        }

        //textiles_structure
        if ($textiles_structure && $query_options) {
            $query_options = " AND w.structure = '{$textiles_structure}'";
        } else if ($textiles_structure) {
            $query_options = " WHERE w.structure = '{$textiles_structure}'";
        }

        //textiles_weaving
        if ($textiles_weaving && $query_options) {
            $query_options = " AND w.weaving = '{$textiles_weaving}'";
        } else if ($textiles_weaving) {
            $query_options = " WHERE w.weaving = '{$textiles_weaving}'";
        }

        //textiles_finishing
        if ($textiles_finishing && $query_options) {
            $query_options = " AND w.finishing = '{$textiles_finishing}'";
        } else if ($textiles_finishing) {
            $query_options = " WHERE w.finishing = '{$textiles_finishing}'";
        }

        //textiles_rating
        if ($textiles_rating && $query_options) {
            $query_options = " AND w.rating = '{$textiles_rating}'";
        } else if ($textiles_rating) {
            $query_options = " WHERE w.rating = '{$textiles_rating}'";
        }

        $query = "SELECT *
                FROM customer_wares AS w
                JOIN customers AS c
                ON w.customer_id = c.id
                {$query_options}";

        $result = DB::select($query);

        return $result;
    }

}
