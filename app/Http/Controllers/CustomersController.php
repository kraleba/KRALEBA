<?php

namespace App\Http\Controllers;

use App\Helpers\CustomerHelper;
use App\Models\Bills;
use App\Models\Customers;
use App\Models\Products;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
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
        $product = new Products();

        if ($request->input()) {

            $data = $this->helper->helper_show_filter($request->input());
            $data['filtering_criteria'] = array(
                'customer_name' => $request->input('customer_name'),
                'type' => $request->input('type'),
                'category' => $this->product->get_customer_category_by_id($request->input('category')),
            );

        }

        $data['customers'] = $this->customers->get_customers_after_filter(
            $request->input('customer_name'),
            $request->input('type'),
            $request->input('category')
        );

        if ($request->input('downloadPDF') == 'PDF') {
            $pdf = PDF::loadView('customers.pdf', $data);
            return $pdf->download('invoice.pdf');
        }
        $data['furnace_categories'] = $product->get_furnace_categories();

        return view('customers.index', $data)
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
//         dd($request->input());
        if ($request->input('type') == 'Provider') {
            $request->validate([
                'name' => 'required',
                'type' => 'required',
                'unique_code' => 'required',
                'country' => 'required',
                'categories_id' => 'required'
            ]);
        } else {
            $request->validate([
                'name' => 'required',
                'type' => 'required',
                'unique_code' => 'required',
                'country' => 'required',
            ]);
        }
        $data = $request->input();

        if ($request->input('type') == 'provider') {

            $categories_id = (array)$request->input('categories_id');
            if (!in_array(8, $categories_id)) {
                $request->validate([
                    'subcategories_id' => 'required',
                ]);
            }
            $customer = Customers::create($data);
            $categories_id = $request->input('categories_id');
            $subcategories_id = $request->input('subcategories_id');
            $this->product->set_customer_categories_and_subcategories($customer->id, $categories_id, $subcategories_id);
        } else {
            Customers::create($data);

        }

        return redirect()->route('customers.index')
            ->with('success', 'customer created successfully.');
    }


//    public function show(Customers $customer)
//    {
//
//    }

    public function edit(Customers $customer)
    {
        $customerCountries = array(
            1 => 'Romania',
            2 => 'UE',
            3 => 'non-UE'
        );
        $data['countries'] = $customerCountries;
        $product = new Products();
        $data['furnace_categories'] = $product->get_furnace_categories();
        $data['subcategories'] = $product->get_subcategory_for_customer_category();

        if ($customer->attributesToArray()['type'] == 'provider') {
            $data['customers'] = $this->customers->get_customer_and_categories_by_id($customer->attributesToArray()['id']);
        } else {
            $data['customers'] = $customer;
        }

        return view('customers.edit', $data);
    }

    public function update(Request $request, Customers $customer)
    {


        $request->validate([
            'name' => 'required',
            'unique_code' => 'required',
            'country' => 'required',
        ]);

        $data = $request->input();

        if ($customer->attributesToArray()['type'] == 'provider') {

            $subcategories_id = $request->input('subcategories_id');
            $categories_id = (array)$request->input('categories_id');

            if (!in_array(8, $categories_id)) {
                $request->validate([
                    'subcategories_id' => 'required',
                ]);
            }

            $this->product->update_customer_categories_and_subcategories($customer->attributesToArray()['id'], $categories_id, $subcategories_id);

        }

        $customer->update($data);

        return redirect()->route('customers.index')
            ->with('success', 'customer updated successfully');
    }

    public function destroy(Customers $customer)
    {

        $result = $this->customers->delete_customer($customer->attributesToArray()['id']);
        $message = 'Client sters cu succes';

        if (!$result) {
            $message = 'Clientul nu a fost sters, a aparut o eroare';
        }

        return redirect()->route('customers.index')
            ->with('success', $message);
    }


    public function delete_subcategory($subcategory_id, $id = null)
    {
        //when an item is deleted from customer create
        if (!$id) {
            $id = $subcategory_id;
        }
        $products = new Products();
        $products->delete_subcategory_by($id);
    }

}
