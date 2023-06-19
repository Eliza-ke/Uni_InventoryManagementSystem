<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(String $id = "0")
    {
        $products = Product::query();
        $categories = Category::all();
        if ($id == "0") {
            $products = $products->paginate(3); // we retrieve all data from database table, like ($products = Product::all())
        }else{
            $products = Product::where('category_id', $id)->paginate(3);
        }    

        return view('viewproduct', compact('products','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        $suppliers = Supplier::orderBy('id', 'desc')->get();

        return view('createproduct', compact('categories','suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pname' => 'required|max:255',
            'category_id' => 'required',
            'supplier_id'  => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
            'img' => 'required|image',
        ]);

        $path = $request->file('img')->store('photo');

        $product = new Product();
        $product->product_name = $validated['pname'];
        $product->category_id = $validated['category_id'];
        $product->supplier_id = $validated['supplier_id'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $product->quantity = $validated['qty'];
        $product->images = $path;

        $product->save();
        session()->flash('createdproduct', 'Created successfully.');
        return redirect('/product');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //nothing to show
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('id', 'desc')->get();
        $suppliers = Supplier::orderBy('id', 'desc')->get();

        return view('editproduct', compact('product', 'categories','suppliers'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'pname' => 'required|max:255',
            'category_id' => 'required',
            'supplier_id'  => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
        ]);
       
        $product = Product::findOrFail($id);

        $product->product_name = $validated['pname'];
        $product->category_id = $validated['category_id'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $product->quantity = $validated['qty'];
        if (isset($request->img)) {
            $path = $request->file('img')->store('photo');
            $product->images = $path;
        }

        $product->save();
        session()->flash('updatedproduct', 'Updated successfully.');
        return redirect('/product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //$product->delete();
        Product::findOrFail($id)->delete();
        session()->flash('deletedproduct', 'Deleted successfully.');
        return redirect('/product');
    }
}
