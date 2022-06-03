<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Products;
use Illuminate\Http\Request;

class CustomersController extends Controller
{

    public function index()
    {
        $customers = Customers::latest()->paginate(5);

        return view('customers.index', compact('customers'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $customerCountries = array(
            1 => 'Romania',
            2 => 'UE',
            3 => 'non-UE'
        );
        $product = new Products();
        $data['furnace_categories'] = $product->get_furnace_categories();
        $data['subcategories'] = $product->get_subcategory_for_customer_category();

        $data['countries'] = $customerCountries;

        return view('customers.create', $data);
    }

    public function store(Request $request)
    {
//        dump($request->input());
//        die('store');
        if($request->input('type') == 'provider') {
            $request->validate([
                'countries' => 'required',
                'detail' => 'required',
            ]);
        }
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'uniqueCode' => 'required'
        ]);
die();
        Customers::create($request->all());

        return redirect()->route('customers.index')
            ->with('success', 'customer created successfully.');
    }


    public function show(Customers $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customers $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customers $customer)
    {
        $request->validate([
            'customerType' => 'required',
            'name' => 'required',
            'uniqueCode' => 'required',
            'detail' => 'required',
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index')
            ->with('success', 'customer updated successfully');
    }

    public function destroy(Customers $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'customer deleted successfully');
    }
}
