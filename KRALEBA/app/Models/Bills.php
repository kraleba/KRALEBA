<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bills extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'unique_code', 'type', 'bill_date', 'bill_number', 'currency', 'exchange', 'TVA', 'item',
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

    public function get_bills_by_customer_id($customer_id)
    {

        $bills = DB::table('bills')->where('customer_id', $customer_id)->get();
        $i = 0;
        foreach ($bills as $bill) {
            $generatedBills[$i] = DB::select("SELECT *
            FROM customer_wares
            LEFT JOIN bills
            ON bills.id = customer_wares.bill_id
            WHERE bills.customer_id = {$customer_id}
            AND customer_wares.bill_id = {$bill->id}");
            $i++;
        }
//        dd($generatedBills);

        return $generatedBills;
    }
}
