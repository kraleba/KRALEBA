<?php

namespace App\Http\Controllers;

use App\Helpers\CustomerHelper;
use App\Models\Customers;
use App\Models\Products;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CustomersController extends Controller
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

    public function index(Request $request)
    {
        $product = new Products();

        if ($request->input('type') || $request->input('category') || $request->input('subcategory')) {
            $data = $this->helper->helper_show_filter($request->input());
            $type = '';
            if ($request->input('type') == 'Provider') {
                $type = 'Furnizor';
            }
            if ($request->input('type') == 'Customer') {
                $type = 'Beneficiar';
            }
            $data['filtering_criteria'] = array(
                'type' => array(
                    'nume' => $type,
                    'name' => $request->input('type')
                ),
                'category' => $this->product->get_customer_category_by_id($request->input('category')),
                'subcategory' => $request->input('subcategory')
            );
        } else {
            $data['customers'] = Customers::get_customers();

        }

        if ($request->input('downloadPDF') == 'PDF') {

            $data['filter_title'] = $this->helper->helper_generate_title_after_filter(
                $request->input('type'),
                $request->input('category'),
                $request->input('subcategory'));

            $pdf = PDF::loadView('customers.pdf', $data);
            return $pdf->download('invoice.pdf');
        }

        $data['furnace_categories'] = $product->get_furnace_categories();
        $data['subcategories'] = $product->get_subcategory_for_customer_category();

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

        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'uniqueCode' => 'required',
            'country' => 'required',
            'subcategory' => 'required'
        ]);
        $helper = new CustomerHelper();

        $data = $request->input();
        $data['subcategory_id'] = $helper->helper_add_subcategory($request->input('subcategory'));

        unset($data['subcategory']);

        $request->input('subcategory');

        Customers::create($data);

        return redirect()->route('customers.index')
            ->with('success', 'customer created successfully.');
    }


    public function show(Customers $customer)
    {
        return view('customers.show', compact('customer'));
    }

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

        $helper = new CustomerHelper();
        $data['customers'] = $helper->helper_get_categories_to_customer($customer->attributesToArray());
//        dump($data['customers']);
//die();
        return view('customers.edit', $data);
    }

    public function update(Request $request, Customers $customer)
    {
//dd($request->input());
        $request->validate([
            'name' => 'required',
            'uniqueCode' => 'required',
            'country' => 'required',
        ]);

        $data = $request->input();
        $helper = new CustomerHelper();

        $data['subcategory_id'] = $helper->helper_add_subcategory($request->input('subcategory'));
        unset($data['subcategory']);

        $customer->update($data);


        return redirect()->route('customers.index')
            ->with('success', 'customer updated successfully');
    }

    public function destroy(Customers $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'customer deleted successfully');
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
