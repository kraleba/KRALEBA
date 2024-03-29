<?php

namespace App\Models;

use Dflydev\DotAccessData\Data;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bills extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'type', 'bill_date', 'bill_number', 'currency', 'exchange', 'tva', 'item',
        'specify_id',
    ];

    public function create_bill_and_update_ware($data)
    {
        $bill = Bills::create($data);

        foreach ($data['wares_id'] as $wares) {
            DB::select("UPDATE customer_wares
                SET status = 1, bill_id = " . $bill->id . "
                WHERE id = {$wares}");
        }
    }

    public function get_customer_bill_by_id($bill_id)
    {
        $i = 0;
        $generatedBills = array();
        $generatedBills[$i] = DB::select(
            "SELECT *
            FROM customer_wares AS w
            LEFT JOIN bills AS b
            ON w.bill_id = b.id
            WHERE w.bill_id = {$bill_id}"
        );
        $i++;

        if ($generatedBills) {
            return $generatedBills;
        } else {
            return false;
        }
    }

    public function get_bill_by_id($bill_id)
    {
        if (is_numeric($bill_id)) {
            return DB::table('bills')->where('id', $bill_id)->first();
        }
        return false;
    }

    public function delete_bill_and_wares($bill_id)
    {

        DB::table('bills')->where('id', $bill_id)->delete();
        DB::table('customer_wares')->where('bill_id', $bill_id)->delete();
    }

    public function get_bills_by_filter($customer_name = false, $type = false, $start_date = false, $end_date = false)
    {

        $query = "
            SELECT
                b.id,
                b.customer_id,
                c.name,
                b.item,
                b.bill_date,
                b.bill_number,
                b.exchange,
                b.tva,
                b.currency
            FROM bills AS b
            JOIN customers AS c
            ON b.customer_id = c.id
            ";

        if ($customer_name) {
            $query .= " WHERE c.name LIKE '%{$customer_name}%'";
        }

        if ($customer_name && $type) {
            $query .= " AND b.type = {$type}";
        } else if ($type) {
            $query .= " WHERE b.type = {$type}";
        }

        if (($customer_name || $type) && ($start_date && $end_date)) {
            $query .= " AND b.bill_date BETWEEN '{$start_date}' AND '{$end_date}'  ORDER BY b.bill_date ASC ";
        } else if ($start_date && $end_date) {
            $query .= " WHERE b.bill_date BETWEEN '{$start_date}' AND '{$end_date}' ORDER BY b.bill_date ASC ";
        }

        $bills = DB::select($query);

        foreach ($bills as $bill) {
            $ware_price = DB::table('bills')
                ->leftJoin('customer_wares', 'customer_wares.bill_id', 'bills.id')
                ->where('bill_id', $bill->id)
                ->sum('price');

            if ($bill->currency == 1) {
                $bill->total_price_euro = $ware_price;
                $bill->total_price_lei = number_format($ware_price * $bill->exchange, 2);

            } else {
                $bill->total_price_euro = number_format($ware_price / $bill->exchange, 2);
                $bill->total_price_lei = $ware_price;
            }
        }
        return $bills;
        
    }

    public function get_bills_to_autocomplete_suggestions($search, $customer_id, $row_name, $ware_custom_code, $ware_product_name_selected, $bill_date)
    {

        if (!$customer_id || !$row_name || !$ware_custom_code || !$ware_product_name_selected) {
            return false;
        }

        $query = "SELECT b.{$row_name}, b.id
                FROM bills AS b
                LEFT JOIN customer_wares AS w
                ON w.bill_id = b.id
                WHERE b.customer_id = {$customer_id}
                AND b.{$row_name} LIKE '%{$search}%'
                AND w.custom_code = '{$ware_custom_code}'
                AND w.product_name = '{$ware_product_name_selected}'
                ";

        if ($bill_date) {
            $query .= "AND b.bill_date = '{$bill_date}'";
        }

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
