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
        $data['templates'] = $this->template_parent->get_product_templates_after_filter();

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
        $parent_template = $request->input();
        unset($parent_template['categories_template_child']);
        unset($parent_template['product_template_child']);

        $child_categories_template = (array)json_decode($request->input('categories_template_child'));
        $child_template = (array)json_decode($request->input('product_template_child'));
//        dd($child_categories_template);

        $this->template_child->create_template_children_by_parent_id($parent_template, $child_template, $child_categories_template);

//        $this->template->create_parent_and_child_template($parent_template, $child_template);

        return redirect()->route('templates.index')
            ->with('success', 'customer created successfully.');
    }


    public function show(Customers $customer)
    {

    }

    public function edit(Customers $customer)
    {

        return view('customers.edit', '$data');
    }

    public function update(Request $request, Customers $customer)
    {


        return redirect()->route('customers.index')
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


}
