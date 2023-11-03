<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

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

    public function update(Request $request)
    {
        $request->validate([
            'brand_id' => 'required',
            'name' => 'required|max:255',
            'path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $name = $request->input('name');
        $brand_id = $request->input('brand_id');

        $brand = Brand::findOrFail($brand_id);

        $oldPath = $brand->path;

        $brand->name = $name;

        if ($request->hasFile('path')) {
            $request->validate([
                'path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Upload the new image
            $brandPath = $request->file('path')->store('public/brand');
            $brandFileURL = '/storage/brand/' . basename($brandPath);
            $brand->path = $brandFileURL;

            // Delete the old image
            if ($oldPath && Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }
        }

        $brand->save();

        return redirect()->route('brand.show')->with('success', 'brand updated successfully');
    }
    
    public function delete($id)
    {
        $brand = Brand::find($id);

        if ($brand) {
            $brand->products()->delete();
            $brand->delete();

            return redirect()->back()->with('success', 'brand and associated products deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'brand not found.');
        }
    }

    public function getCategories()
    {
        $brands = bBrand::orderBy('sort', 'desc')->get();
        return response()->json($brands);
    }
}