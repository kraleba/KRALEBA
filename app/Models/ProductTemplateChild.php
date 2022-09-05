<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\Exception\InvalidOrderException;

class ProductTemplateChild extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'suffix',
        'template_child_photo',
        'created_at',
        'updated_at'
    ];

    public function create_template_children_by_parent_id($parent_template, $child_template, $child_categories_template)
    {

        $parent = ProductTemplateParent::create($parent_template);
        if ($parent->id && is_numeric($parent->id)) {

            for ($i = 0, $j = 0; $i < $parent_template['number_of_child']; $i++) {

                $child_template['parent_id'] = $parent->id;
                $child_template['suffix'] = $i;
                $child = ProductTemplateChild::create($child_template);

                foreach ($child_categories_template[$i] as $child_categories) {
                    $child_categories[$j]->template_child_id = $child->id;
                    TemplateChildCategories::create((array)$child_categories[$j]);
                }
            }
        }

    }

    public function validate_child_template_if_data_exists($child_fields)
    {
        if ((
            !$child_fields['customer_name'] || !$child_fields['customer_id'] || !$child_fields['product_name'] ||
                !$child_fields['custom_code'] || !$child_fields['bill_number'] || !$child_fields['bill_date'] ||
                !$child_fields['amount']) && !is_numeric($child_fields['customer_id']
            )) {

            return false;

        }

        $query = "
            SELECT c.id
            FROM customers AS c
            LEFT JOIN bills AS b
            ON c.id = b.customer_id
            LEFT JOIN customer_wares AS w
            ON w.bill_id = b.id
            WHERE c.id = {$child_fields['customer_id']}
            AND w.product_name = '{$child_fields['product_name']}'
            AND w.custom_code = '{$child_fields['custom_code']}'
            AND b.bill_number = '{$child_fields['bill_number']}'
            AND b.bill_date = '{$child_fields['bill_date']}'
        ";

        if (DB::select($query)) {
            return true;
        }
    }

}
