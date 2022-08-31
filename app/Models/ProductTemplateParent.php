<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductTemplateParent extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'category',
        'theme',
        'styles',
        'occasion',
        'seasonality',
        'author',
        'collection',
        'marketing_category_id',
        'cuffs',
        'slits',
        'sleeves',
        'pockets',
        'stitching',
        'seams_colour',
        'buttons',
        'interlining',
        'product_name',
        'number_of_child'
    ];

    public function get_product_templates_after_filter()
    {

        $query = "SELECT
                    ptp.product_name,
                    ptp.number_of_child,
                    ptp.id,
                    ptc.suffix
                FROM product_template_parents AS ptp
                JOIN product_template_children AS ptc
                    ON ptp.id = ptc.parent_id
                /*JOIN template_child_categories AS tcc
                    ON tcc.template_child_id = ptc.id*/
              /*  GROUP BY ptp.id*/
                ";
        $result = DB::select($query);
//dd($result);
        return $result;
    }

    public function get_parent_template_product_by_suggestions($term)
    {
        if (!$term) {
            return false;
        }

        $query = "SELECT id, product_name FROM product_template_parents WHERE product_name LIKE '%{$term}%'";

        return DB::select($query);
    }
}
