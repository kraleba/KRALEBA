<?php

namespace App\Http\Controllers;

use App\Helpers\CustomerHelper;
use App\Models\Bills;
use App\Models\Customers;
use App\Models\Products;
use App\Models\ProductsMarket;
use App\Models\ProductTemplate;
use App\Models\TemplateChildren;
use App\Models\TemplateParents;
use Illuminate\Http\Request;

class ProductMarketController extends Controller
{
    public Products $product;
    public Customers $customers;
    public Bills $bills;
    public CustomerHelper $helper;
    public ProductTemplate $template;
    public TemplateParents $template_parent;
    public TemplateChildren $template_child;

    public function __construct()
    {
        $this->product = new Products();
        $this->customers = new Customers();
        $this->helper = new CustomerHelper();
        $this->bills = new Bills();
        $this->template = new ProductTemplate();
        $this->template_parent = new TemplateParents();
        $this->template_child = new TemplateChildren();
    }

    public function index(Request $request)
    {
        return view('products_market.market_index',)
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {

        $data['customer_categories'] = $this->product->get_furnace_categories();
        $data['marketing_categories'] = $this->template->get_marketing_template_categories();

        return view('products_market.market_create', $data);
    }

    public function store(Request $request)
    {
//        dd($request->input());
        $customer = ProductsMarket::create($request->input());


        return redirect()->route('market.index')
            ->with('success', 'customer created successfully.');
    }


}
