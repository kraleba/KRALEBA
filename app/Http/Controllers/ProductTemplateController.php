<?php

namespace App\Http\Controllers;

use App\Helpers\CustomerHelper;
use App\Models\Bills;
use App\Models\Customers;
use App\Models\Products;
use App\Models\ProductTemplate;
use App\Models\ProductTemplateChild;
use App\Models\ProductTemplateParent;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductTemplateController extends Controller
{

    public Products $product;
    public Customers $customers;
    public Bills $bills;
    public CustomerHelper $helper;
    public ProductTemplate $template;
    public ProductTemplateParent $template_parent;
    public ProductTemplateChild $template_child;

    public function __construct()
    {
        $this->product = new Products();
        $this->customers = new Customers();
        $this->helper = new CustomerHelper();
        $this->bills = new Bills();
        $this->template = new ProductTemplate();
        $this->template_parent = new ProductTemplateParent();
        $this->template_child = new ProductTemplateChild();
    }

    public function index(Request $request)
    {


        // $data['templates'] = $this->template_parent->get_product_templates_after_filter();
        $templates = DB::table('product_template_parents')
            ->select('*', 'product_template_parents.id', 'product_template_children.id as child_id')
            ->leftJoin('product_template_children', 'product_template_children.parent_id', 'product_template_parents.id');

        if ($request->type) {
            $templates = $templates->where('product_template_parents.type', $request->type);
        }
        if ($request->product_name) {
            $templates = $templates->where('product_template_parents.product_name', $request->product_name);
        }
        if ($request->collection) {
            $templates = $templates->where('product_template_parents.collection', $request->collection);
        }
        // if ($request->code) {
        //     $templates = $templates -> where('product_template_parents.code', $request->code);
        // }
        if ($request->author) {
            $templates = $templates->where('product_template_parents.author', $request->author);
        }
        if ($request->category) {
            $templates = $templates->where('product_template_parents.category', $request->category);
        }
        if ($request->theme) {
            $templates = $templates->where('product_template_parents.theme', $request->theme);
        }
        // if ($request->tayloring) {
        //     $templates = $templates -> where('product_template_parents.tayloring', $request->tayloring);
        // }
        if ($request->occasion) {
            $templates = $templates->where('product_template_parents.occasion', $request->occasion);
        }
        if ($request->seasonality) {
            $templates = $templates->where('product_template_parents.seasonality', $request->seasonality);
        }
        if ($request->syles) {
            $templates = $templates->where('product_template_parents.', $request->occasion);
        }
        if ($request->syles) {
            $templates = $templates->where('product_template_parents.occasion', $request->syles);
        }
        if ($request->occasion) {
            $templates = $templates->where('product_template_parents.occasion', $request->occasion);
        }
        if ($request->occasion) {
            $templates = $templates->where('product_template_parents.occasion', $request->occasion);
        }
        if ($request->occasion) {
            $templates = $templates->where('product_template_parents.occasion', $request->occasion);
        }
        $data['templates'] = $templates
            ->orderBy('product_template_parents.product_name')
            ->get();
        // dump($data['templates']);

        $data['taylorings'] = DB::table('marketing_template_categories')->select('name')->get();

        return view('products_template.template_index', $data);
    }

    public function create()
    {
        $data['customer_categories'] = $this->product->get_furnace_categories();
        $data['marketing_categories'] = $this->template->get_marketing_template_categories();

        return view('products_template.template_create', $data);
    }

    public function store(Request $request)
    {

        // $request->validate([
        //     'template_photo1' => 'required',
        //     'template_photo1.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        // if ($request->images){
            //tre sa fac validatorul pentru imagini
        $images = [
            'template_photo1' => $request->template_photo1,
            'template_photo2' => $request->template_photo2,
            'template_photo3' => $request->template_photo3
        ];
        $child_template = [];

        // for ($i = 1; $i <= 3; $i++) {
        //     foreach ($images['template_photo' . $i] as $key => $image) {
        //         $imageName = time() . rand(1, 99) . '.' . $image->extension();
        //         $image->move(public_path('images/templates'), $imageName);

        //         $child_template[$key]['template_photo'.$i] = $imageName;
        //     }
        // }
        $parent_template = $request->input();
        unset($parent_template['categories_template_child']);
        $child_categories_template = (array)json_decode($request->input('categories_template_child'));
        dd($child_categories_template);

        $this->template_child->create_template_children_by_parent_id($parent_template, $child_template, $child_categories_template);


        return redirect()->route('templates.index')
            ->with('success', 'customer created successfully.');
    }


    public function show(Request $request)
    {
        // dd('sadfsdf_');
        return redirect()->route('templates.index');
    }

    public function edit(Customers $customer)
    {

        return view('customers.edit', '$data');
    }

    public function update(Request $request, Customers $customer)
    {

        return redirect()->route('templates.index')
            ->with('success', 'customer updated successfully');
    }

    public function destroy(Customers $customer)
    {
        //        $customer->delete();
        $result = $this->customers->delete_customer($customer->attributesToArray()['id']);
        $message = 'Client sters cu succes';
        if (!$result) {
            $message = 'Clientul nu a fost sters, a aparut o eroare';
        }
        return redirect()->route('customers.index')
            ->with('success', $message);
    }

    public function show_template_child(Request $request)
    {
        $data['template_parent'] = DB::table('product_template_parents')
            ->where('id', $request->parent_id)
            ->first();

        $data['template_parent']->marketing_category = DB::table('marketing_template_categories')
            ->where('id', $data['template_parent']->marketing_category_id)
            ->first();

        $data['template_child'] = DB::table('product_template_children')
            ->leftJoin('template_child_categories', 'product_template_children.id', 'template_child_categories.template_child_id')
            ->where('template_child_categories.template_child_id', $request->child_id)
            ->get();
            // tre sa vad cum fac sa nu se mai repete pozele
        dump($data['template_parent']);
        dump($data['template_child']);

        return view('products_template.product_child.show', $data);
    }

    public function show_template_table(Request $request)
    {


        $data['template_parent'] = DB::table('product_template_parents')
            ->where('id', $request->parent_id)
            ->first();

        $data['template_child'] = DB::table('product_template_children')
            ->leftJoin('template_child_categories', 'product_template_children.id', 'template_child_categories.template_child_id')
            ->leftJoin('customer_wares', 'template_child_categories.ware_id', 'customer_wares.id')
            ->leftJoin('bills', 'customer_wares.bill_id', 'bills.id')
            ->where('template_child_categories.template_child_id', $request->child_id)
            ->get();

        dump($data['template_parent']);
        dump($data['template_child']);

        return view('products_template.product_child.table_show', $data);
    }
}
