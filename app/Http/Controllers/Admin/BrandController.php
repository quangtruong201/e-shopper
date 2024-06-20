<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\CountryRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Brand::paginate(5);
        return view('admin.brand.brand',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.brand.add_brand');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request)
    {
        //
        Brand::create($request->all());
        return redirect("/admin/brand/list");
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = Brand::find($id);
        return view('admin.brand.edit_brand', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, string $id)
    {
        //
        $id = Brand::find($id);
        $data = $request->all();
        $brand = $id->update($data);
        return redirect("/admin/brand/list");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Brand::find($id);
        $data->delete();
        return redirect("/admin/brand/list");
    }
}
