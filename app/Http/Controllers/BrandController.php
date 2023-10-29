<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function view()
    {
        $brands = Brand::with('products')->get();
        return view('client.brand', compact('brands'));
    }


    public function show()
    {
        $brands = brand::all();
        return view('admin.brand', compact('brands'));
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:255',  
            'path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $name = $request->input('name');
        $existingbrand = brand::where('name', $validatedData['name'])->first();

        if ($existingbrand) {
            return back()->with('error', 'The brand name already exists. Please choose another name.');
        }

        $brand = new Brand();
        $brand->name =$name;

        if ($request->hasFile('path')) {
            $brandPath = $request->file('path')->store('public/brand');
            $brandFileURL = '/storage/brand/' . basename($brandPath);
            $brand->path = $brandFileURL;
        }
        $brand->save();

        return redirect()->back()->with('success', 'brand created successfully');
    }

    public function delete(Brand $id)
    {
        $brand = Brand::find($id);
        
        if (!$brand) {
            return redirect()->back()->with('error', 'brand not found.');
        }
        
        $brand->delete();
        return redirect()->route('brand.view')->with('success', 'brand deleted successfully.');
    }

    public function getCategories()
    {
        $brands = bBrand::orderBy('sort', 'desc')->get();
        return response()->json($brands);
    }
}