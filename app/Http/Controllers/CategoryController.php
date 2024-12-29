<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categories::where('status', '=', '0')->get();

        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        $categories = Categories::where('status', '=', '0')->get();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'slug' => 'required|max:255|unique:categories,slug',
            'description' => 'required',
        ]);

        Categories::create($validatedData);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $categories = Categories::where('status', '=', '0')->get();
        $category = Categories::find($id);
        return view('admin.categories.edit', compact('categories', 'category'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'slug' => ['required', 'max:255', Rule::unique('categories')->ignore($request->id)],
            'description' => 'nullable',
        ]);


        $category = Categories::find($id);
        $category->name = $validatedData['name'];
        $category->parent_id = $validatedData['parent_id'];
        $category->slug = $validatedData['slug'];
        $category->description = $validatedData['description'];
        $category->update();

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Categories::find($id);
        $category->status = 1;
        $category->update();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
