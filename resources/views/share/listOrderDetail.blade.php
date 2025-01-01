@extends('layouts.share')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>List Order</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('dashboard') }}">Home</a>
                            <a href="{{ route('shop') }}">Shop</a>
                            <span>List Order</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Review</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($orderDetails->count() > 0)
                                    @foreach ($orderDetails as $od)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td><img src="{{ asset('storage/' . $od->media->mediaUrl)}}" alt="{{$od->product->name}}" width="50px"></td>
                                            <td>{{$od->product->name}}</td>
                                            <td>{{$od->size->name}}</td>
                                            <td>{{$od->color->name}}</td>
                                            <td>{{$od->quantity}}</td>
                                            <td class="cart__price">
                                                {{ number_format($od->price * 1000, 0, ',', '.') }}đ
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
Review</button>
</td>

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <!-- review-form.blade.php -->
      <form action="{{ route('review.store', ['orderId' => $orderDetails->first()->orderId]) }}" method="POST">
    @csrf
    
    <div class="rating-wrapper mb-3">
        <h5>Đánh giá của bạn</h5>
        <div class="rating">
            @for($i = 5; $i >= 1; $i--)
            <input type="radio" id="rating-{{$i}}" name="rating" value="{{$i}}" required>
            <label for="rating-{{$i}}" class="star">
                <i class="fas fa-star fa-2x"></i>
            </label>
            @endfor
        </div>
        @error('rating')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="comment" class="form-label">Nội dung đánh giá:</label>
        <textarea 
            class="form-control" 
            id="comment" 
            name="comment" 
            rows="6" 
            required
        ></textarea>
        @error('comment')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
    </div>
</form>   
     

<!-- JavaScript -->

    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
                    @if (session('success'))
                        <div class="alert alert-success mt-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{ route('viewOrder') }}">Return List Order</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.rating input');
    const feedbackText = document.querySelector('.feedback-text');
    
    stars.forEach(star => {
        star.addEventListener('change', function() {
            const rating = this.value;
            console.log(`Selected rating: ${rating}`);
        });
    });
});
</script>  
@endsection
