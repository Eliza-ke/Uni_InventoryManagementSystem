<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Purchaseorder;
use Illuminate\Support\Facades\Auth;

class PurchaseorderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchaseorder = Purchaseorder::orderBy('created_at', 'desc')->paginate(5);       
        return view('viewpurchaseorder', compact('purchaseorder'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $product = Product::findOrFail($id);
        return view('reorder', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reorder_quantity' => 'required|numeric',           
        ]);

        $purchase = new Purchaseorder();
        $purchase->product_id = $request->product_id;
        $purchase->purchase_qty = $validated['reorder_quantity'];
        $purchase->orderedperson = Auth::user()->name;
        $purchase->status = 'incomplete';
        $purchase->received_qty = 0;

        $purchase->save();
        return redirect('/purchaseorder');
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
        $purchase = Purchaseorder::findOrFail($id);
        return view('editpurchase', compact('purchase'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'reorder_quantity' => 'required|numeric',
        ]);
        
        $purchase = Purchaseorder::findOrFail($id);

        $purchase->purchase_qty = $validated['reorder_quantity'];
        $purchase->save();
        return redirect('/purchaseorder');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //$product->delete();
        Purchaseorder::findOrFail($id)->delete();
        return redirect('/purchaseorder');
    }
}
