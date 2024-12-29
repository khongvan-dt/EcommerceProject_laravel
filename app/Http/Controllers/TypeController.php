<?php

namespace App\Http\Controllers;

use App\Models\Types;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index(){
        $types = Types::all();
        return view('admin.types.index', compact('types'));
    }

    public function create(){
        return view('admin.types.create');
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'name' =>'required|max:255',
        ]);

        Types::create($validateData);

        return redirect()->route('admin.types.index')->with('success', 'Type created successfully.');
    }

    public function edit($id){
        $type = Types::find($id);
        return view('admin.types.edit', compact('type'));
    }

    public function update(Request $request, $id){
        $validateData = $request->validate([
            'name' =>'required|max:255',
            'status' => 'required|in:0,1',
        ]);

        $attribute = Types::find($id);
        $attribute->update($validateData);

        return redirect()->route('admin.types.index')->with('success', 'Type updated successfully.');
    }

    public function destroy($id){
        $attribute = Types::find($id);
        $attribute->status = 1;
        $attribute->update();

        return redirect()->route('admin.types.index')->with('success', 'Type deleted successfully.');
    }
}
