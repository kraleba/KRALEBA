<?php

namespace App\Models;

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

    public static function get_customers()
    {
        return DB::table('customers')
            ->orderBy('name', 'asc')
            ->get();
    }

    public function get_customers_after_filter($type, $category_id, $subcategory)
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


}


