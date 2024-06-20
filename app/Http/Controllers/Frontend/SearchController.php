<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function searchProduct(Request $request)
     {
         if ($request->has('search_content')) {
             $search_content = $request->search_content;
             $result = Product::where('name', 'like', '%' . $search_content . '%')->get()->toArray();
             // dd($result);
             return view('frontend.search.search', compact('result'));
         } else {
             return redirect()->back()->with('error', 'Search content is missing.');
         }
 
     }

     public function searchProductAdvanced(Request $request)
     {
         $request->all();
 
         $query = Product::query();
 
         if ($request->filled('name')) {
             $query->where('name', 'like', '%' . $request->name . '%');
         }
 
         if ($request->filled('price_range')) {
             $priceRange = explode('-', $request->price_range);
             if (count($priceRange) == 2) {
                 $query->whereBetween('price', [(int)$priceRange[0], (int)$priceRange[1]]);
             }
         }
 
         if ($request->filled('category')) {
            $query->where('id_category', $request->category);
        }
 
         if ($request->filled('brand')) {
            $query->where('id_brand', $request->brand);
        }
        
        
 
         if ($request->filled('status')) {
             if ($request->status == 'new') {
                 $query->where('status', 0);
             } elseif ($request->status == 'sale') {
                 $query->where('status', 1);
             }
         }
 
         $result = $query->paginate(10);
 
         $categories = Category::all();
         $brands = Brand::all();
 
         return view('frontend.search.search_advanced', compact('result', 'categories', 'brands'));
     }
 
 
     public function index()
     {
         $categories = Category::all();
        //  dd($categories);
         $brands = Brand::all();
         $result = collect();
         return view('frontend.search.search_advanced', compact('categories', 'brands', 'result'));
     }


     public function filterProducts(Request $request)
        {
            $minPrice = $request->minPrice;
            $maxPrice = $request->maxPrice;

            // Query products based on price range
            $filteredProducts = Product::whereBetween('price', [$minPrice, $maxPrice])->get();

            return view('frontend.filtered.filtered_products', compact('filteredProducts'));
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
        //
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
