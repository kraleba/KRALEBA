<?php

namespace App\Http\Controllers;

use App\Helpers\CustomerHelper;
use App\Models\CustomerWares;
use App\Models\Customers;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;


class CustomerWaresControler extends Controller
{
    public Products $product;
    public Customers $customers;
    public CustomerHelper $helper;
    public CustomerWares $wares;

    public function __construct()
    {
        $this->product = new Products();
        $this->customers = new Customers();
        $this->helper = new CustomerHelper();
        $this->wares = new CustomerWares();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        //        dd($request);
        $data['furnace_categories'] = $this->product->get_furnace_categories();
        $data['subcategories'] = $this->product->get_subcategory_for_customer_category();
        $data['customer_id'] = $request->customer_id;
        $data['filter_title'] = $this->helper->helper_generate_title_after_filter_wares($request->customer_name ?? '', $request->category ?? '', $request->subcategory ?? '');
        $data['wares'] = $this->wares->get_wares_by_filter($request->customer_name ?? '', $request->category ?? '', $request->subcategory ?? '');
        $data['filtering_criteria'] = array(
            'customer_name' => $request->input('customer_name'),
            'category' => $this->product->get_customer_category_by_id($request->input('category')),
            'subcategory' => $request->input('subcategory'),
        );

        if ($request->input('downloadPDF') == 'PDF') {
            $pdf = PDF::loadView('ware.pdf', $data);
            return $pdf->download('invoice.pdf');
        }

        return view('ware.ware_index', $data);
    }

    public function create(Request $request)
    {
        $data['customer'] = (array)$this->customers->get_customer_and_categories_by_id($request->customer_id);
        $data['customer_categories'] = $this->helper->customer_separe_categories_from_subcategories($data['customer']);
        $data['coin'] = $this->helper->show_coin_by_country($data['customer']['country']);
        //dd($data['customer']);
        if (!$data['customer_categories']) {
            return '<h1>Acest client nu are categorii</h1>';
        }

        return view('ware.ware_create', $data);
    }

    public function store(Request $request)
    {
        $data = $request->input();
        $customer_categories_subcategories = json_decode($data['categories_json']);

        $data['category_id'] = $customer_categories_subcategories->category_id;
        $data['subcategory_id'] = $customer_categories_subcategories->subcategory_id;

        unset($data['categories_json']);
        //dd($data);
        CustomerWares::create($data);

        return redirect()->route('wares.index', $request->input('customer_id'))
            ->with('success', 'customer created successfully.');
    }

    public function show(CustomerWares $custmerWares)
    {
        dd('testeee343');
    }

    public function edit(Request $request)
    {


        $data['ware'] = (array)$this->wares->get_ware_by_id($request->ware);
        $data['customer'] = (array)$this->customers->get_customer_and_categories_by_id($request->customer_id);
        $data['customer_categories'] = $this->helper->customer_separe_categories_from_subcategories($data['customer']);
        $data['coin'] = $this->helper->show_coin_by_country($data['customer']['country']);
        //        dd($data['ware']);

        return view('ware.ware_edit', $data);
    }

    public function update(Request $request)
    {
        //        dd($request->ware);
        $this->wares->ware_update($request->input(), $request->ware);

        return redirect()->route('wares.index', $request->input('customer_id'))
            ->with('success', 'customer updated successfully');
    }

    public function destroy(Request $request)
    {
        //        dd($request->ware);
        $result = $this->wares->delete_ware_by_id($request->ware);

        $message = 'Client sters cu succes';
        if (!$result) {
            $message = 'Clientul nu a fost sters, a aparut o eroare';
        }

        return redirect()->route('wares.index', $request->customer_id)
            ->with('success', $message);
    }

    public function customers_textile(Request $request)
    {
        $data['furnace_categories'] = $this->product->get_furnace_categories();
        $data['subcategories'] = $this->product->get_subcategory_for_customer_category();
        $data['customer_id'] = $request->customer_id;
        $data['filter_title'] = $this->helper->helper_generate_title_after_filter_textile($request->all());
        $data['filtering_criteria'] = array(
            'customer_name' => $request->input('customer_name'),
            'textiles_composition' => $request->input('textiles_composition'),
            'textiles_material' => $request->input('textiles_material'),
            'textiles_design' => $request->input('textiles_design'),
            'textiles_color' => $request->input('textiles_color'),
            'textiles_structure' => $request->input('textiles_structure'),
            'textiles_weaving' => $request->input('textiles_weaving'),
            'textiles_finishing' => $request->input('textiles_finishing'),
            'textiles_rating' => $request->input('textiles_rating')
        );

        $ware_query = DB::table('customer_wares')
            ->leftJoin('customers', 'customers.id', '=', 'customer_wares.customer_id');
        if ($request->customer_name) {
            $ware_query = $ware_query
                ->where('customers.name', 'LIKE', "%$request->customer_name%");
        }
        if ($request->textiles_composition) {
            $ware_query = $ware_query
                ->where('customer_wares.composition', $request->textiles_composition);
        }
        if ($request->textiles_material) {
            $ware_query = $ware_query
                ->where('customer_wares.material', $request->textiles_material);
        }
        if ($request->textiles_design) {
            $ware_query = $ware_query
                ->where('customer_wares.design', $request->textiles_design);
        }
        if ($request->textiles_color) {
            $ware_query = $ware_query
                ->where('customer_wares.color', $request->textiles_color);
        }
        if ($request->textiles_structure) {
            $ware_query = $ware_query
                ->where('customer_wares.structure', $request->textiles_structure);
        }
        if ($request->textiles_weaving) {
            $ware_query = $ware_query
                ->where('customer_wares.weaving', $request->textiles_weaving);
        }
        if ($request->textiles_finishing) {
            $ware_query = $ware_query
                ->where('customer_wares.finishing', $request->textiles_finishing);
        }
        if ($request->textiles_rating) {
            $ware_query = $ware_query
                ->where('customer_wares.rating', $request->textiles_rating);
        }

        $data['wares'] = $ware_query
            ->where('customer_wares.category_id', 8)
            ->orderBy('customer_wares.product_name')
            ->get();

        if ($request->input('downloadPDF') == 'PDF') {
            $pdf = PDF::loadView('ware.textiles.pdf', $data);
            return $pdf->download('invoice.pdf');
        }


        return view('ware.textiles.customers_textile', $data);
    }
}
