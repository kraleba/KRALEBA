<?php

namespace App\Http\Controllers;

use App\Helpers\CustomerHelper;
use App\Models\Bills;
use App\Models\Customers;
use App\Models\Products;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ProductTemplateController extends Controller
{

    public Products $product;
    public Customers $customers;
    public Bills $bills;
    public CustomerHelper $helper;

    public function __construct()
    {
        $this->product = new Products();
        $this->customers = new Customers();
        $this->helper = new CustomerHelper();
        $this->bills = new Bills();
    }

    public function index(Request $request)
    {
//dd('test');
        return view('products_template.template_index', )
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {


        return view('customers.create', $data);
    }

    public function store(Request $request)
    {


        return redirect()->route('customers.index')
            ->with('success', 'customer created successfully.');
    }


    public function show(Customers $customer)
    {

    }

    public function edit(Customers $customer)
    {


        return view('customers.edit', $data);
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
