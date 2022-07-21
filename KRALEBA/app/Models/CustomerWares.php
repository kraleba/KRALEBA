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
//dd($customer_id);
        if ($customer_id) {
            $query = "SELECT *
            FROM customers
            LEFT JOIN customer_wares
            ON customers.id = customer_wares.customer_id
            WHERE customer_wares.customer_id = {$customer_id}
            AND customer_wares.status = {$status}";

        } else {
            $status = 1;
            $query = "SELECT *
            FROM customers
            LEFT JOIN customer_wares
            ON customers.id = customer_wares.customer_id
            WHERE customer_wares.status = {$status}";

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
//        dd($data);
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

        if ($ware_type == 'wares') {
            $textile = 'Textile';
            $simbol = '!= ';
        } elseif ($ware_type == 'Textile') {
            $simbol = "=";
            $textile = $ware_type;
        }
        $query = "SELECT
                customer_wares.id,
                customer_wares.customer_id,
                customer_wares.product_name,
                customer_wares.custom_code,
                customer_wares.description,
                customer_wares.date,
                customer_wares.coin,
                customer_wares.um,
                customer_wares.amount
                FROM customer_wares
                JOIN customers
                ON customer_wares.customer_id = customers.id
                WHERE customer_wares.category_id {$simbol} '{$textile}'";

        if ($type) {
            $query .= " AND customers.type = '{$type}'";
        }

        if ($type && $category) {
            $query .= " AND customer_wares.category_id = {$category}";
        }

        if ($type && $subcategory) {
            $query .= " AND customer_wares.subcategory_id = {$subcategory}";

        } else if ($subcategory) {
            $query .= " AND customer_wares.subcategory_id = {$subcategory}";
        }

//        dd($query);

        return DB::select($query);
    }

}
