<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
            for ($i = 0; $i < $parent_template['number_of_child']; $i++) {

                $child_template['parent_id'] = $parent->id;
                $child_template['suffix'] = $i;
                $child = ProductTemplateChild::create($child_template);

                foreach ($child_categories_template[$i] as $child_categories) {
//                    dump( $child_categories);
                    $child_categories->template_child_id = $child->id;
                    TemplateChildCategories::create((array)$child_categories);
//                        dd($child_category);
                }
            }
        }

    }
}
