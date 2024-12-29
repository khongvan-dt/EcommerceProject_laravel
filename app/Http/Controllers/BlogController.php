<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blogs::where('status', '!=', '2')->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create(){
        return view('admin.blogs.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' =>'required',
            'slug' => 'required|max:255|unique:blogs,slug',
            'content' => 'required',
            'image' =>'required|image|mimes:webp,jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')){
            $imagePath = $request->file('image')->store('blogs', 'public');
            $validatedData['image'] = $imagePath;
        };

        $blog = new Blogs();
        $blog->title = $request->title;
        $blog->slug = $request->slug;
        $blog->content = $request->content;
        $blog->image = $validatedData['image'];
        $blog->status = 0;
        $blog->save();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully');
    }

    public function edit($id){
        $blog = Blogs::find($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    public function publish($id){
        $blog = Blogs::find($id);
        $blog->status = 1;
        $blog->update();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog published successfully');
    }

    public function unpublish($id){
        $blog = Blogs::find($id);
        $blog->status = 0;
        $blog->update();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog unpublished successfully');
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' =>'required',
            'slug' => ['required','max:255', function($attribute, $value, $fail) use ($id){
                if(Blogs::where('id', '!=', $id)->where('slug', $value)->exists()){
                    $fail('Slug has already been taken.');
                }
            }],
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $blog = Blogs::find($id);
        $blog->title = $request->title;
        $blog->slug = $request->slug;
        $blog->content = $request->content;

        if ($request->hasFile('image')){
            $imagePath = $request->file('image')->store('blogs', 'public');
            $validatedData['image'] = $imagePath;
            $blog->image = $validatedData['image'];
        };

        $blog->update();
    
        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully');
    }

    public function destroy($id){
        $blog = Blogs::find($id);
        $blog->status = 2;
        $blog->update();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully');
    }
}
