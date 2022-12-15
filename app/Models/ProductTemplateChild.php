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
        'template_photo1',
        'template_photo2',
        'template_photo3',
        'created_at',
        'updated_at'
    ];

    public function create_template_children_by_parent_id($parent_template, $child_template, $child_categories_template)
    {

        $parent = ProductTemplateParent::create($parent_template);
        if ($parent->id && is_numeric($parent->id)) {

            for ($i = 0, $j = 0; $i < $parent_template['number_of_child']; $i++) {

                $child_template[$i]['parent_id'] = $parent->id;
                $child_template[$i]['suffix'] = $i;
                $child = ProductTemplateChild::create($child_template[$i]);
                foreach ($child_categories_template[$i] as $child_categories) {
                    foreach ($child_categories as $child_category) {
                        $child_category->template_child_id = $child->id;
                        TemplateChildCategories::create((array)$child_category);
                    }
                }
            }
        }
    }

}
