<?php


namespace App\Http\Controllers;

use App\Helpers\CustomerHelper;
use App\Models\Bills;
use App\Models\Customers;
use App\Models\Products;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class BillsController extends Controller
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

    public function index()
    {
        $data['furnace_categories'] = $this->product->get_furnace_categories();

        $data['bills'] = Bills::orderBy('id', 'desc')->paginate(5);
        $data['subcategories'] = $this->product->get_subcategory_for_customer_category();

        return view('bills.bills_index', $data);
    }

    public function create()
    {
        return view('bills.bills_create');
    }

    public function store(Request $request)
    {
        // dd($request->input());
        $request->validate([
            'custumer_id' => 'required',
            'bill_date' => 'required',
            'bill_number' => 'required',
            'currency' => 'required',
            'exchange' => 'required',
            'TVA' => 'required',
            'item' => 'required',
            'type' => 'required',
            // 'category_id' => 'required',
            // 'specify_id' => 'required',
        ]);

        Bills::create($request->input());

        return redirect()->route('bills.index')
            ->with('success', 'Bills has been created successfully.');
    }


    public function show(Bills $bills)
    {
        // return view('bills.show', compact('bills'));
    }


    public function edit(Bills $bill)
    {
        // dd($bill->attributesToArray());
        return view('bills.bills_edit', compact('bill'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        $bills = Bills::find($id);
        $bills->name = $request->name;
        $bills->email = $request->email;
        $bills->address = $request->address;
        $bills->save();
        return redirect()->route('bills.index')
            ->with('success', 'Bills Has Been updated successfully');
    }

    public function generate_bill(Request $request)
    {
        $customer = $this->customers->get_customer_by_id($request->id);


        $data = array(
            'customer' => $customer,
            'coin' => $this->helper->show_coin_by_country($customer->country),
        );
//        dd($customer);
        return view('bills.bills_create', $data);

    }


}
