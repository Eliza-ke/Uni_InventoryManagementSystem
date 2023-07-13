<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cat = Category::query()->paginate(3);
        return view('viewcategory', compact('cat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('createcategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|max:255',
        ]);

        $category = new Category();
        $category->catname = $validated['category'];

        $category->save();
        session()->flash('createdcategory', 'Created successfully.');
        return redirect('/category');
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
        $category = Category::findOrFail($id);
        return view('editcategory', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'category' => 'required|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->catname = $validated['category'];

        $category->save();
        session()->flash('updatedcategory', 'Updated successfully.');
        return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::statement('DELETE FROM products WHERE category_id = ?', [$id]);
        Category::destroy($id);
        session()->flash('deletedcategory', 'Deleted successfully.');
        return redirect('/category');
    }
}
