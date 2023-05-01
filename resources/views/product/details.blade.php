@extends('layouts.front_layout.front_layout')

@section('content')
    <div class="main-warapper">
        <div class="products-details">

            <div class="content">
                <div class="pictures">
                    @foreach($productDetails->media as $key => $proImage)
                    <img id="pic{{$key+1}}" onmouseover="changeImage('{{asset("/storage/".$proImage->product_image)}}', '{{$key+1}}')" src="{{asset('/storage/'.$proImage->product_image)}}">

                    @endforeach
                </div>
                <div class="picture" id="picture">
                    <div class="rect" id="rect"></div>
                    <img style="width: 420px; height: 606px;" id="pic" src="{{asset('/storage/')}}/@if($productDetails->media->count()){{$productDetails->media->first()->product_image}}@endif" >
                </div>
                <div class="zoom" style="margin-left: 100px; margin-top: 50px" id="zoom"></div>
            </div>


            <div class="details">
                <form action="{{url('/add-cart')}}" method="post" class="needs-validation" novalidate>{{csrf_field()}}
                    <input type="hidden" name="product_id" id="product_id" value="{{$productDetails->id}}">
                    <input type="hidden" name="product_url" id="product_url" value="{{$productDetails->product_url}}">
                    <input type="hidden" name="product_name" id="product_name" value="{{$productDetails->product_name}}">
                    <input type="hidden" name="price" id="price" value="{{$productDetails->user_price}}">
                    <input type="hidden" name="preprice" id="price" value="{{$productDetails->premium_price}}">
                    <h3>{{$productDetails->product_name}}</h3>
                    <h4>Brand: {{$productDetails->brands->name}}</h4>
                    <h4>Shop:  {{$productDetails->shop->shop_name}}</h4>
                    @if(\Illuminate\Support\Facades\Auth::check())
                        @if(\Illuminate\Support\Facades\Auth::user()->type != 'GU')
                            <h4 class="price">
                                <span class="premium">TK {{$productDetails->premium_price}}</span>
                                <span class="general">TK {{$productDetails->user_price}} (for general users) </span>
                            </h4>
                            @else
                            <h4 class="price">
                                <span class="premium">TK {{$productDetails->user_price}}</span>
                                <span class="general">TK {{$productDetails->premium_price}} (for premium users) </span>
                            </h4>

                        @endif
                        @else
                        <h4 class="price">
                            <span class="premium">TK {{$productDetails->user_price}}</span>
                            <span class="general">TK {{$productDetails->premium_price}} (for premium users) </span>
                        </h4>
                        @endif

                    <div class="row">
                        <?php
                            $sizes = explode(",", $productDetails->product_size);
                        ?>
                        @if(count($sizes) > 0)
                            <div class="group">
                                <label for="size">Size</label>
                                <select name="size" id="size">
                                    <option value="" style="color: #000;" disabled selected> Choose Size</option>
                                    @foreach($sizes as $size)
                                        <option style="color: #000;" value="{{$size}}"> {{$size}}</option>
                                     @endforeach`
                                </select>
                            </div>
                            @endif
                       @if(count($productDetails->media) > 0)
                            <div class="group">
                                <label for="color">Color</label>
                                <select name="color" id="color">
                                    <option style="color: #000;" value="" disabled selected> Choose Color</option>
                                    @foreach($productDetails->media as $color)
                                        <option value="{{$color->product_color}}"  data-display="Choose color" style="padding: 10px !important; background: {{$color->product_color}}" >{{$color->product_color}}</option>
                                     @endforeach
                                </select>
                            </div>
                        @endif



                        <div class="group">
                            <label for="quantity">Quanity</label>
                            <select name="quantity" id="quantity">
                                <option style="color: #000;" value="" disabled selected> Choose Quanity</option>
                                <option style="color: #000;" value="1">1</option>
                                <option style="color: #000;" value="2">2</option>
                                <option style="color: #000;" value="3">3</option>
                                <option style="color: #000;" value="4">4</option>
                                <option style="color: #000;" value="5">5</option>
                                <option style="color: #000;" value="6">6</option>
                                <option style="color: #000;" value="7">7</option>
                                <option style="color: #000;" value="8">8</option>
                                <option style="color: #000;" value="9">9</option>
                                <option style="color: #000;" value="10">10</option>
                            </select>
                        </div>


                    </div>

                    <button type="submit" class="submit-button">Add Cart</button>
                </form>
                <div class="clear-both-now">

                </div>
                <div class="pdetails">
                    <h4>Product Details of the {{$productDetails->product_name}}</h4>
                    <p>{!! $productDetails->description !!}</p>
                </div>
            </div>

        </div>









        <div class="product-wrapper related-product">
            <h4>Related Product</h4>
            @foreach($g_products as $product)
            <div class="single-product">
                <a href="{{url('/product-details/'.$product->product_url)}}">
                    <img src="{{asset('/storage/')}}/@if($product->media->count()){{$product->media->first()->product_image}}@endif" alt="">
                    <h4>{{ $product->product_name }}</h4>
                </a>
            </div>
          @endforeach
        </div>
    </div>

@endsection

@push('js')

    <script>
        var picture = document.querySelector('#pic');
        var container = document.querySelector('.pictures');
        const allBox=container.children;
        picLists = Array();
        for(let i = 0; i <= allBox.length; i++){
            picLists[i-1] = document.querySelector('#pic'+i);
        }
        picList = picLists;

        var mainContainer = document.querySelector('#picture');

        var rect = document.querySelector("#rect");

        var zoom = document.querySelector('#zoom');

        let picActive = 1;

        picList[0].classList.add('img-active');

        zoom.style.backgroundImage = "url(" + picture.src + ")";
        function changeImage(imgSrc, n) {
            picture.src = imgSrc;
            zoom.style.backgroundImage = "url(" + imgSrc + ")";
            picList[picActive-1].classList.remove('img-active');
            picList[n-1].classList.add('img-active');
            picActive = n;
        }


        let w1 = mainContainer.offsetWidth;
        let h1 = mainContainer.offsetHeight;

        let ratio = 3;

        zoom.style.backgroundSize = w1 * ratio + 'px ' + h1 * ratio + 'px';

        let x, y, xx, yy;

        let w2 = rect.offsetWidth;
        let h2 = rect.offsetHeight;

        zoom.style.width = w2 * ratio + 'px';
        zoom.style.height = h2 * ratio + 'px';

        w2 = w2/2;
        h2 = h2/2;

        function move(event) {
            x = event.offsetX;
            y = event.offsetY;

            xx = x - w2;
            yy = y - h2;
            if (x < w2) {
                x = w2;
                xx = 0;
            }
            if (x > w1 - w2) {
                x = w1 - w2;
                xx = x - w2;
            }
            if (y < h2) {
                y = h2;
                yy = 0;
            }
            if (y > h1 - h2) {
                y = h1 - h2;
            }

            xx = xx * ratio;
            yy = yy * ratio;
            rect.style.left = x + 'px';
            rect.style.top = y + 'px';
            zoom.style.backgroundPosition = '-' + xx + 'px ' + '-' + yy + 'px';
        }

        function addOpacity() {
            rect.classList.add('rect-active');
            zoom.classList.add('rect-active');
        }

        mainContainer.addEventListener('mousemove', function(){
            move(event);
            addOpacity();
            zoom.classList.remove('rect-no-razib');
            zoom.style.display = "block";
        });

        function removeOpacity() {
            zoom.classList.remove('rect-active');
            rect.classList.remove('rect-active');
            zoom.classList.add('rect-no-razib');
        }

        mainContainer.addEventListener('mouseout', function() {
            removeOpacity();
            zoom.style.display = "none";
        })
    </script>

@endpush