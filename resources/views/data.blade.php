@foreach($products as $product)
<div class="single-product">
    <a href="{{url('/product-details/'.$product->product_url)}}">
        <img src="{{asset('/storage/')}}/@if($product->media->count()){{$product->media->first()->product_image}}@endif" alt="">
        <h4>{{ $product->product_name }}</h4>
    </a>
</div>
@endforeach