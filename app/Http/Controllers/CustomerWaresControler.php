<?php

namespace App\Http\Controllers;

use App\Helpers\CustomerHelper;
use App\Models\CustomerWares;
use App\Models\Customers;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Bills;

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
        $data['filter_title'] = $this->helper->helper_generate_title_after_filter($request->customer_type ?? '', $request->category ?? '', $request->subcategory ?? '');

        if ($request->customer_id) {
            $data['wares'] = $this->wares->get_wares_by_customer_id($request->customer_id);
            $data['wares_count'] = count($data['wares']);
        } else {
            $data['wares'] = $this->wares->get_wares_by_filter('wares', $request->customer_type ?? '', $request->category ?? '', $request->subcategory ?? '');
        }

        return view('ware.ware_index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $data['customer'] = (array)$this->customers->get_customer_and_categories_by_id($request->customer_id);
        $data['customer_categories'] = $this->helper->customer_separe_categories_from_subcategories($data['customer']);
        $data['coin'] = $this->helper->show_coin_by_country($data['customer']['country']);

        if(!$data['customer_categories']) {
            return '<h1>Acest client nu are categorii</h1>';
        }

        return view('ware.ware_create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->input();

        if ($request->input('categories_json') == 'Textile') {
            $data['category_id'] = 8;

        } else {
            $category = json_decode($request->input('categories_json'));
            $data['category_id'] = isset($category->category_id);
            $data['subcategory_id'] = isset($category->id);

        }
        unset($data['categories_json']);
//        dd($data);

        CustomerWares::create($data);

        return redirect()->route('wares.index', $request->input('customer_id'))
            ->with('success', 'customer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\CustomerWares $custmerWares
     * @return Response
     */
    public function show(CustomerWares $custmerWares)
    {
        dd('testeee343');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\CustomerWares $custmerWares
     * @return Response
     */
    public function edit(Request $request)
    {


        $data['ware'] = (array)$this->wares->get_ware_by_id($request->ware);
        $data['customer'] = (array)$this->customers->get_customer_and_categories_by_id($request->customer_id);
        $data['customer_categories'] = $this->helper->customer_separe_categories_from_subcategories($data['customer']);
        $data['coin'] = $this->helper->show_coin_by_country($data['customer']['country']);
//        dd($data['ware']);

        return view('ware.ware_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CustomerWares $custmerWares
     * @return Response
     */
    public function update(Request $request)
    {
//        dd($request->ware);
        $this->wares->ware_update($request->input(), $request->ware);

        return redirect()->route('wares.index', $request->input('customer_id'))
            ->with('success', 'customer updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CustomerWares $customerWares
     * @return \Illuminate\Http\RedirectResponse
     */
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
        $data['filter_title'] = $this->helper->helper_generate_title_after_filter(
            $request->customer_type ?? '',
            $request->category ?? '',
            $request->subcategory ?? ''
        );

        if ($request->customer_id) {
            $data['wares'] = $this->wares->get_wares_by_customer_id($request->customer_id);
            $data['wares_count'] = count($data['wares']);
        } else {
            $data['wares'] = $this->wares->get_wares_by_filter(
                'Textile',
                $request->customer_type ?? '',
                $request->category ?? '',
                $request->subcategory ?? ''
            );
        }

        /*if filter exist*/
        if ($request->input()) {
            $data['wares'] = $this->wares->get_suggestions_for_textiles_filters(
                $request->input('customer_name'),
                $request->input('textiles_composition'),
                $request->input('textiles_material'),
                $request->input('textiles_design'),
                $request->input('textiles_color'),
                $request->input('textiles_structure'),
                $request->input('textiles_weaving'),
                $request->input('textiles_finishing'),
                $request->input('textiles_rating'));
        }

        return view('ware.textiles.customers_textile', $data);

    }


}
