<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class BlogController extends Controller
{
    public function index(){
        $blogs = Blogs::where('status', '!=', '2')->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create(){
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|max:255|unique:blogs,slug',
            'content' => 'required',
            'image' => 'required|image|mimes:webp,jpeg,png,jpg|max:2048',
        ]);
    
         $storagePath = storage_path('app/public/blogs');
        if (!File::exists($storagePath)) {
            File::makeDirectory($storagePath, 0775, true);
        }
    
        $blog = new Blogs();
        $blog->title = $request->title;
        $blog->slug = $request->slug;
        $blog->content = $request->content;
        $blog->status = 0;
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            
             $image->move(public_path('storage/blogs'), $imageName);
            $blog->image = 'blogs/' . $imageName;
        }
    
        $blog->save();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'slug' => ['required', 'max:255', function($attribute, $value, $fail) use ($id) {
                if(Blogs::where('id', '!=', $id)->where('slug', $value)->exists()) {
                    $fail('Slug has already been taken.');
                }
            }],
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $blog = Blogs::findOrFail($id);
        $blog->title = $request->title;
        $blog->slug = $request->slug;
        $blog->content = $request->content;
    
        if ($request->hasFile('image')) {
             if ($blog->image && File::exists(public_path('storage/' . $blog->image))) {
                File::delete(public_path('storage/' . $blog->image));
            }
    
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            
             $image->move(public_path('storage/blogs'), $imageName);
            $blog->image = 'blogs/' . $imageName;
        }
    
        $blog->save();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully');
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

    

    public function destroy($id){
        $blog = Blogs::find($id);
        $blog->status = 2;
        $blog->update();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully');
    }
}
