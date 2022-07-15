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
        $data['furnace_categories'] = $this->product->get_furnace_categories();
        $data['customer_id'] = $request->customer_id;
        $data['wares'] = $this->wares->get_wares_to_customer($request->customer_id);
//        $data['wares'] = CustomerWares::orderBy('id', 'desc')->paginate(5);
        $data['wares_count'] = count($data['wares']);
//        dd($data['wares_count']);
        $data['subcategories'] = $this->product->get_subcategory_for_customer_category();


        return view('ware.ware_index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {

        $data['customer'] = $this->customers->get_customer_and_categories_by_id($request->customer_id);
        $data['coin'] = $this->helper->show_coin_by_country($data['customer']['country']);
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
//        dd($request->ware);
        $data['ware'] = (array)$this->wares->get_ware_by_id($request->ware);
        $data['customer'] = $this->customers->get_customer_and_categories_by_id($request->customer_id);
        $data['coin'] = $this->helper->show_coin_by_country($data['customer']['country']);
//dd($data['ware']);
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

}
