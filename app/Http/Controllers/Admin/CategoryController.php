<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CountryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::paginate(5);
        return view('admin.category.category', compact('data'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.category.add_category');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request)
    {
        //
        Category::create($request->all());
        return redirect("/admin/category/list");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = Category::find($id);
        return view('admin.category.edit_category', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, string $id)
    {
        //
        $id = Category::find($id);
        $data = $request->all();
        $brand = $id->update($data);
        return redirect("/admin/category/list");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Category::find($id);
        $data->delete();
        return redirect("/admin/category/list");

    }
}
