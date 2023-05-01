@extends('layouts.front_layout.front_layout')

@section('content')

    <div class="product-wrapper" id="post_data">
        <h4>Product</h4>
        @foreach($products as $product)
            <div class="single-product">
                <a href="{{url('/product-details/'.$product->product_url)}}">
                    <img src="{{asset('/storage/')}}/@if($product->media()->count()){{$product->media()->first()->product_image}}@endif" alt="">
                    <h4>{{ $product->product_name }}</h4>
                </a>
            </div>
        @endforeach

        {{ $products->links() }}

    </div>



@endsection