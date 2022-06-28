<?php

namespace App\Http\Controllers;

use App\Models\Bills;
use Illuminate\Http\Request;

class BillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['bills'] = Bills::orderBy('id', 'desc')->paginate(5);
        return view('bills.bills_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bills.bills_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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
        // $bills = new Bills;
        Bills::create($request->input());
        // $bills->name = $request->name;
        // $bills->email = $request->email;
        // $bills->address = $request->address;
        // $bills->save();
        return redirect()->route('bills.index')
            ->with('success', 'Bills has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Bills $bills
     * @return \Illuminate\Http\Response
     */
    public function show(Bills $bills)
    {
        // return view('bills.show', compact('bills'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Bills $bills
     * @return \Illuminate\Http\Response
     */
    public function edit(Bills $bill)
    {   
        // dd($bill->attributesToArray());
        return view('bills.bills_edit', compact('bill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Bills $bills
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Bills $bills
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bills $bills)
    {
        $bills->delete();
        return redirect()->route('bills.index')
            ->with('success', 'Bills has been deleted successfully');
    }
}
