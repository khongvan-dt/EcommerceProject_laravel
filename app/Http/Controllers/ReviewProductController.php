<?php

namespace App\Http\Controllers;
use App\Models\ReviewProducts;
class ReviewProductController extends Controller
{

    public function index()
    {
        $reviewProducts = ReviewProducts::with([
            'product:id,name', 
            'user:id,firstName,lastName'
        ])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('admin.reviews.products', compact('reviewProducts'));
    }

    public function destroy($id)
    {
        try {
            $review = ReviewProducts::findOrFail($id);
            $review->delete();
            
            return redirect()->route('admin.reviewProducts.index')
                           ->with('success', 'Đã xóa đánh giá thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.reviewProducts.index')
                           ->with('error', 'Không thể xóa đánh giá này!');
        }
    }
}
