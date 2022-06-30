<?php

namespace App\Http\Controllers;

use App\Models\Bills;
use Illuminate\Http\Request;

class BillsController extends Controller
{

    public function index()
    {
        $data['bills'] = Bills::orderBy('id', 'desc')->paginate(5);
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


    public function destroy(Bills $bills)
    {
        $bills->delete();
        return redirect()->route('bills.index')
            ->with('success', 'Bills has been deleted successfully');
    }


    public function generate_bill(Request $request) {

        return view('bills.bills_create');

    }

}
