<?php

namespace App\Http\Controllers;

use App\Models\ProductMedia;
use Illuminate\Http\Request;

class ProductMediaController extends Controller
{
    public function index($id)
    {
        $medias = ProductMedia::where('productId', $id)->get();
        return view('admin.productMedia.index', $medias);
    }

    public function create()
    {
        return view('admin.productMedia.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'productId' => 'required|exists:products,id',
            'mediaUrl' => 'required|file',
            'mediaType' => 'required|in:image,doc',
        ]);

        if ($request->hasFile('mediaUrl')) {
            $file = $request->file('mediaUrl');
            $folder = ($validatedData['mediaType'] == 'doc') ? 'products/doc' : 'products/image';

            $filePath = $file->store($folder, 'public');
            $media = new ProductMedia();
            $media->product_id = $validatedData['productId'];
            $media->media_url = $filePath;
            $media->media_type = $validatedData['mediaType'];
            $media->save();
        }
        return redirect()->route('admin.media.index')->with('success', 'Media file uploaded successfully.');
    }

    public function edit($id)
    {
        $media = ProductMedia::find($id);
        return view('admin.media.edit', compact('media'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'productId' => 'required|exists:products,id', 
            'mediaUrl' => 'nullable|file', 
            'mediaType' => 'nullable|in:image,doc', 
        ]);

        $media = ProductMedia::find($id);

        $media->product_id = $validatedData['productId'];

        if ($request->hasFile('mediaUrl')) {
            $file = $request->file('mediaUrl');

            $folder = ($validatedData['mediaType'] == 'doc') ? 'products/doc' : 'products/image';

            $filePath = $file->store($folder, 'public');

            $media->media_url = $filePath;
            $media->media_type = $validatedData['mediaType'] ?? 'image'; 
        }

        $media->save();

        return redirect()->route('admin.media.index')->with('success', 'Media file updated successfully.');
    }


    public function destroy($id)
    {
        $media = ProductMedia::find($id);
        $media->delete();
        return redirect()->route('admin.media.index')->with('success', 'Media file deleted successfully.');
    }
}
