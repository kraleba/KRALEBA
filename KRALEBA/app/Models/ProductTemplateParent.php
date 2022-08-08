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
        'category_style_id',
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

    public function get_product_templates_after_filter() {

        $query = "
            SELECT
                ptp.product_name, ptp.id, ptc.suffix
            FROM
                product_template_parents AS ptp
            JOIN
                product_template_children AS ptc
            JOIN
                template_child_categories AS tcc
            WHERE
                ptp.id = ptc.parent_id
            AND
                tcc.template_child_id = ptc.id
            ";
//dump($query);
        $result = DB::select($query);
    }
}
