<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Job;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    public function view()
    {
        $categories = Category::withCount('jobs')->orderBy('created_at','asc')->get(['id', 'name']);
        $topCategories = $this->getTopCategoriesWithMostJobs();

        return view('client.category', 
        [
            'categories' => $categories,
            'topCategories' => $topCategories,
        ]);
    }

    public function show()
    {
        $categories = Category::orderBy('created_at', 'asc')->get();

        return view('admin.category', ['categories' => $categories]);
    }
    
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',  
            'path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',      
        ]);

        $category = new Category();
        $category->name=$request->input('name');

        if ($request->hasFile('path')) {
            $categoryPath = $request->file('path')->store('public/category');
            $categoryFileURL = '/storage/category/' . basename($categoryPath);
            $category->path = $categoryFileURL;
        }
        $category->save();
        
        return redirect()->back()->with('success', 'Category created successfully');
    }

    public function update(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|max:255',
            'path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $name = $request->input('name');
        $category_id = $request->input('category_id');

        $category = Category::findOrFail($category_id);

        // Get the old image path before updating
        $oldPath = $category->path;

        $category->name = $name;

        if ($request->hasFile('path')) {
            $request->validate([
                'path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Upload the new image
            $categoryPath = $request->file('path')->store('public/category');
            $categoryFileURL = '/storage/category/' . basename($categoryPath);
            $category->path = $categoryFileURL;

            // Delete the old image
            if ($oldPath && Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }
        }

        $category->save();

        return redirect()->route('category.show')->with('success', 'Category updated successfully');
    }

    public function delete($id)
    {
        $category = Category::find($id);

        if ($category) {
            // Delete the associated products
            $category->products()->delete();

            $category->delete();

            return redirect()->back()->with('success', 'Category and associated products deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Category not found.');
        }
    }


    public function getTopCategoriesWithMostJobs()
    {
        $categories = Category::withCount('jobs')->orderByDesc('jobs_count')->take(5)->get();

        return $categories;
    }

    public function getCategoryData()
    {
        $categories = Category::withCount('jobs')->orderBy('created_at','asc')->get(['id', 'name']);

        return response()->json($categories);
    }
}