<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('viewsupplier', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('createsupplier');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_name' => 'required|max:255',
            'supplier_email' => 'required|max:255', 
            'supplier_phone' => 'required|max:255',
        ]);

        $supplier = new Supplier();
        $supplier->supplier_name = $validated['supplier_name'];
        $supplier->supplier_email = $validated['supplier_email'];
        $supplier->supplier_phone = $validated['supplier_phone'];
        $supplier->save();

        session()->flash('createdsupplier', 'Created successfully.');
        return redirect('/supplier');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('editsupplier', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'supplier_name' => 'required|max:255',
            'supplier_email' => 'required|max:255',
            'supplier_phone' => 'required|max:255',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->supplier_name = $validated['supplier_name'];
        $supplier->supplier_email = $validated['supplier_email'];
        $supplier->supplier_phone = $validated['supplier_phone'];
        $supplier->save();

        session()->flash('updatedsupplier', 'Updated successfully.');
        return redirect('/supplier');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Supplier::destroy($id);
        session()->flash('deletedsupplier', 'Deleted successfully.');
        return redirect('/supplier');
    }
}
