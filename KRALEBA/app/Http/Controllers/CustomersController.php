<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customers::latest()->paginate(5);

        return view('customers.index',compact('customers'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        Customers::create($request->all());

        return redirect()->route('customers.index')
            ->with('success','customer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customers  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customers $customer)
    {
        return view('customers.show',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customers $customer)
    {
        return view('customers.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customers $customer)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index')
            ->with('success','customer updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customers  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customers $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success','customer deleted successfully');
    }
}
