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
        $data['companies'] = Bills::orderBy('id', 'desc')->paginate(5);
        return view('companies.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);
        $bills = new Bills;
        $bills->name = $request->name;
        $bills->email = $request->email;
        $bills->address = $request->address;
        $bills->save();
        return redirect()->route('companies.index')
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
        return view('companies.show', compact('bills'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Bills $bills
     * @return \Illuminate\Http\Response
     */
    public function edit(Bills $bills)
    {
        return view('companies.edit', compact('bills'));
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
        return redirect()->route('companies.index')
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
        return redirect()->route('companies.index')
            ->with('success', 'Bills has been deleted successfully');
    }
}
