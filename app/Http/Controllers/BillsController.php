<?php


namespace App\Http\Controllers;

use App\Helpers\CustomerHelper;
use App\Models\Bills;
use App\Models\Customers;
use App\Models\CustomerWares;
use App\Models\Products;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BillsController extends Controller
{
    public Products $product;
    public Customers $customers;
    public CustomerHelper $helper;
    public Bills $bills;
    public CustomerWares $wares;

    public function __construct()
    {
        $this->product = new Products();
        $this->customers = new Customers();
        $this->helper = new CustomerHelper();
        $this->bills = new Bills();
        $this->wares = new CustomerWares();
    }

    public function index(Request $request)
    {

        $data['customer_id'] = $request->customer_id;
        $data['bills'] = $this->bills->get_bills_by_filter($request->customer_type, $request->type, $request->start_date, $request->end_date);

//        dd($data['bills']);

        $data['subcategories'] = $this->product->get_subcategory_for_customer_category();

        return view('bills.bills_index', $data);
    }

    public function create(Request $request)
    {
//        dd($request->customer_id);
        $customer = (array)$this->customers->get_customer_and_categories_by_id($request->customer_id);
//        dd($customer['country']);

        $data = array(
            'customer' => $customer,
            'wares' => $this->wares->get_wares_id_from_customer_id($request->customer_id),
            'coin' => $this->helper->show_coin_by_country($customer['country']),
            'furnace_categories' => $this->product->get_furnace_categories(),
            'subcategories' => $this->product->get_subcategory_for_customer_category(),
        );
//        dd($data['customer']['customer_id']);
        return view('bills.bills_create', $data);

    }

    public function store(Request $request)
    {
//        dd($request->input());

        $request->validate([
//            'custumer_id' => 'required',
            'bill_date' => 'required',
            'bill_number' => 'required',
//            'currency' => 'required',
            'exchange' => 'required',
            'tva' => 'required',
//            'item' => 'required',
//            'type' => 'required',
//            // 'category_id' => 'required',
//            // 'specify_id' => 'required',
        ]);

        $this->bills->create_bill_and_update_ware($request->input());
//        Bills::create($request->input());


        return redirect()->route('bills.index', $request->customer_id)
            ->with('success', 'Bills has been created successfully.');
    }


    public function show(Request $request)
    {
        $data['customer_id'] = $request->customer_id;
        $bills = $this->bills->get_customer_bill_by_id($request->customer_id, $request->bill);
        $data['bills'] = $this->helper->bills_value_calculated_ware($bills);

//        dd($request->bill);
        return view('bills.bills_show', $data);

    }

    public function edit(Request $request)
    {
        $data['bill'] = $this->bills->get_bill_by_id($request->bill);
        $data['customer'] = (array)$this->customers->get_customer_by_id($request->customer_id);
        $data['wares'] = $this->wares->get_wares_by_customer_id($request->customer_id, 1);
//        dd($data['wares']);

        return view('bills.bills_edit', $data);
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

    public function destroy(Request $request)
    {
//        dd($request->customer_id);
        $result = $this->bills->delete_bill_and_wares($request->bill);
        $message = 'Factura stearsa cu succes';
        if (!$result) {
            $message = 'Clientul nu a fost sters, a aparut o eroare';
        }
        return redirect()->route('bills.index', $request->customer_id)
            ->with('success', $message);
    }

    public function generate_bill(Request $request)
    {
        $customer = $this->customers->get_customer_and_categories_by_id($request->id);

        $data = array(
            'customer' => $customer,
            'wares' => $this->wares->get_wares_id_from_customer_id($request->id),
            'coin' => $this->helper->show_coin_by_country($customer['country']),
            'furnace_categories' => $this->product->get_furnace_categories(),
            'subcategories' => $this->product->get_subcategory_for_customer_category(),
        );
//        dd($data['customer']['customer_id']);
        return view('bills.bills_create', $data);

    }

    public function customer_bills()
    {
        //  dd($data["customer"]);
        dd('asssiiccc');
//        $data["customer"]=$this->customers->get_customer_and_categories_by_id($customer->id);
//        $data["generated_bills"]=$this->bills->get_customer_bill_by_id($customer->id);
//        dd($data);

        return view('customers.show', $data);
    }

}
