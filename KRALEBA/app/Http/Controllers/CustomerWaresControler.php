<?php

namespace App\Http\Controllers;

use App\Helpers\CustomerHelper;
use App\Models\CustomerWares;
use App\Models\Customers;
use App\Models\Products;
use Illuminate\Http\Request;

class CustomerWaresControler extends Controller
{
    public Products $product;
    public Customers $customers;
    public CustomerHelper $helper;

    public function __construct()
    {
        $this->product = new Products();
        $this->customers = new Customers();
        $this->helper = new CustomerHelper();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['furnace_categories'] = $this->product->get_furnace_categories();
        $data['customer_id'] = $request->customer_id;
        $data['wares'] = CustomerWares::orderBy('id', 'desc')->paginate(5);
        $data['subcategories'] = $this->product->get_subcategory_for_customer_category();

//        dd($data['wares']);

        return view('ware.ware_index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {

        $data['customer'] = $this->customers->get_customer_and_categoryes_by_id($request->customer_id);
//dd($data['customer']);
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
//        dd($request->input());
        $data = $request->input();
//        unset($data['_token']);
        CustomerWares::create($data);

        return redirect()->route('wares.index', $request->input('customer_id'))
            ->with('success', 'customer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\CustomerWares $custmerWares
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerWares $custmerWares)
    {
        dd('testeee343');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\CustomerWares $custmerWares
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerWares $custmerWares)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CustomerWares $custmerWares
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerWares $custmerWares)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CustomerWares $custmerWares
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerWares $custmerWares)
    {
        //
    }

}
