<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function product(Request $request)
    {
        $products = Product::with('brand', 'category');
        $initialProductCount = $products->count();

        // Apply filters here

        
        // Filter by Brand
        $selectedBrand = $request->input('brand');
        if ($selectedBrand) {
            $products = $products->whereHas('brand', function ($query) use ($selectedBrand) {
                $query->where('name', $selectedBrand);
            });
        }

        // Filter by Category
        $selectedCategory = $request->input('category');
        if ($selectedCategory) {
            $products = $products->whereHas('category', function ($query) use ($selectedCategory) {
                $query->where('name', $selectedCategory);
            });
        }

        // Filter by Price Range
        $selectedPriceRange = $request->input('price_range');
        if ($selectedPriceRange) {
            [$minPrice, $maxPrice] = explode('-', $selectedPriceRange);
            $products = $products->whereBetween('price', [$minPrice, $maxPrice]);
        }

        // Filter by Year
        $selectedYear = $request->input('year');
        if ($selectedYear) {
            $products = $products->whereYear('created_at', $selectedYear);
        }

        // Sort
        $selectedSort = $request->input('sort');
        if ($selectedSort) {
            $products = $products->orderBy('price', $selectedSort);
        }
        $filteredProductCount = $products->count();


        $products = $products->get();
        $brands = Brand::pluck('name');
        $categories = Category::pluck('name');
        return view('product', compact('products', 'brands', 'categories', 'initialProductCount', 'filteredProductCount'));
    }
        
    public function show()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $products = Product::all();

        return view('admin.product',compact('brands', 'categories','products'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable',
            'image' =>'required|mimetypes:image/jpeg,image/png,image/gif,video/mp4|max:65536',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageFilePath = $imageFile->store('public/product'); 
            $imageFileURL = '/storage/product/' . basename($imageFilePath);
        }
        
        $product = new Product([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imageFileURL,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
        ]);

        $product->save();

        return redirect()->back()->with('success', 'Product saved successfully.');
    }

    public function delete($id)
    {
        $Product = Product::find($id);
        
        if (!$Product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $Product->delete();

        return redirect()->route('product-admin')->with('success', 'Product deleted successfully.');
    }

    public function update(Request $request){

    }
    // public function show($id)
    // {
    //     $product = Product::with('brand', 'category')->findOrFail($id);

    //     return response()->json([
    //         'name' => $product->name,
    //         'price' => $product->price,
    //         'description' => $product->description,
    //         'image' => $product->image,
    //         'brand' => $product->brandCategory['brand'],
    //         'category' => $product->brandCategory['category'],
    //     ]);
    // }
}