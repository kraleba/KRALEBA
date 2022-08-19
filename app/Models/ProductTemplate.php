<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductTemplate extends Model
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

    public function get_style_template_categories()
    {
        return DB::table('style_template_categories')->get();
    }

    public function get_marketing_template_categories()
    {
        return DB::table('marketing_template_categories')->get();
    }

    public function create_parent_and_child_template($parent, $child)
    {
        $query_insert = "INSERT INTO product_template_parent
                    (
                        type,
                        category_style_id,
                        marketing_category_id,
                        cuffs,
                        slits,
                        sleeves,
                        pockets,
                        stitching,
                        seams_colour,
                        buttons,
                        interlining,
                        product_name,
                        number_of_child
                    ) VALUES (
                        {$parent['type']},
                        {$parent['category_style_id']},
                        {$parent['marketing_category_id']},
                        {$parent['cuffs']},
                        {$parent['slits']},
                        {$parent['sleeves']},
                        {$parent['pockets']},
                        {$parent['stitching']},
                        {$parent['seams_colour']},
                        {$parent['buttons']},
                        {$parent['buttons']},
                        {$parent['interlining']},
                        {$parent['product_name']},
                        {$parent['number_of_child']}
                    )";
//        $parent_id = DB::insert($query_insert);
//        dd($parent_id);
    }
}
