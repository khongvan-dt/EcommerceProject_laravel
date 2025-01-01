@extends('layouts.admin')

@section('content')

    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Review Products</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#0">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Reviews
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="tables-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style mb-30">
                            <div class="table-wrapper table-responsive">
                            <table class="table">
    <thead>
        <tr>
            <th>
                <h6>STT</h6>
            </th>
            <th>
                <h6>Sản phẩm</h6>
            </th>
            <th>
                <h6>Người đánh giá</h6>
            </th>
            <th>
                <h6>Rating</h6>
            </th>
            <th>
                <h6>Comment</h6>
            </th>
            <th>
                <h6>Status</h6>
            </th>
            <th>
                <h6>Action</h6>
            </th>
        </tr>
    </thead>
   

<tbody>
    @forelse($reviewProducts as $index => $review)
    <tr>
        <td>
            <p>{{ $index + 1 }}</p>
        </td>
        <td>
            <p>{{ $review->product->name ?? 'N/A' }}</p>
        </td>
        <td>
            <p>{{ ($review->user->firstName . ' ' . $review->user->lastName) ?? 'N/A' }}</p>
        </td>
        <td class="rating-stars">
            <div class="stars">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= $review->rating)
                        <i class="fas fa-star text-warning"></i>
                    @else
                        <i class="far fa-star text-warning"></i>
                    @endif
                @endfor
            </div>
        </td>
        <td>
            <p>{{ Str::limit($review->comment, 50) }}</p>
        </td>
        <td>
            @if($review->status == 1)
                <span class="status-btn active-btn">Active</span>
            @else
                <span class="status-btn close-btn">Inactive</span>
            @endif
        </td>
        <td>
            <div class="action">
                <form action="{{ route('admin.reviewProducts.destroy', $review->id) }}" 
                      method="POST" 
                      style="display: inline;"
                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-danger" style="border: none; background: none;">
                        <i class="lni lni-trash-can"></i>
                    </button>
                </form>
            </div>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="7" class="text-center">Không có dữ liệu đánh giá</td>
    </tr>
    @endforelse
</tbody>


</table>


                                <!-- end table -->
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- ========== title-wrapper end ========== -->
        </div>
        <!-- end container -->
    </section>
@endsection
