<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Purchaseorder;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->user_roll != 1){
            abort(403);
        }
        $invoices = Invoice::query()->get();
        return view('invoice', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'received_quantity' => 'required|numeric',
            'remained_quantity' => 'required|numeric',
            'each_price' => 'required|numeric',
        ]);

        $invoice = new Invoice();
        $purchase = Purchaseorder::findOrFail($request->purchase_id);

        $invoice->purchase_id = $request->purchase_id;
        $invoice->received_quantity = $validated['received_quantity'];
        $invoice->remained_quantity = $validated['remained_quantity'];
        $invoice->each_price = $validated['each_price'];
        $invoice->total_price = ($validated['received_quantity'] * $validated['each_price']);
        $invoice->save();

        if ($validated['remained_quantity'] == 0) {
            $purchase->status = 'completed';
        } else {
            $purchase->status = 'remaining';
        }
        $purchaseQty = $purchase->received_qty + $validated['received_quantity'];
        $purchase->received_qty = $purchaseQty;
        $purchase->save();

        $product = Product::findOrFail($request->product_id);

        $productQty = $product->quantity + $validated['received_quantity'];
        $product->quantity = $productQty;
        $product->save();

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
