<?php

use App\Model\Ecommerce\Api\EcoCategory;
$categories = EcoCategory::with('sub_categories')->get();
//$categories = json_decode(json_encode($categories));
//echo "<pre>"; print_r($categories); die;
function brands($id){
    return \App\Model\Ecommerce\EcoBrand::where('sub_category_id', $id)->get();
}

use App\Model\Ecommerce\Api\EcoProduct;
$cartCount = EcoProduct::cartCount();
use Illuminate\Support\Facades\Auth;

use App\Model\Bdealer\Bdealer;
if(Auth::check()){
    $bdealerCount = Bdealer::where('user_id', Auth::user()->id)->count();

}else{
    $bdealerCount = 0;
}


$dealerfirst = Bdealer::with('type')->join('users', 'users.id', '=', 'bdealers.user_id')->where('users.id', Auth::id())->first();
$dealerfirst = json_decode(json_encode($dealerfirst));

?>




<nav class="nav2" id="navbar_top">
    <label class="icon">
        <span class="fa fa-bars chairyok"></span>
    </label>

    <label class="icon2">
        <span class="fa fa-bars"></span>
    </label>
    <label class="logo"><a href="{{url('/')}}"><img src="{{asset('frontend/image/logo.png')}}"></a></label>

    <div class="form-submit-sm">
        <form action="{{url('/search-product')}}" class="input-group" method="get" > {{csrf_field()}}
            <input type="search" name="query" id="query" class="search-small typeahead" placeholder="Search" required>
            <button type="submit" style="background: none;border: none; margin-right: 10px;"><i  class="fas fa-search small-search-icon" style="color: #fff; font-size: 18px;"></i></button>
        </form>
    </div>
    <span class="cart-icon-small">
         @if(request()->is('dealer-service') || request()->is('dealer-purchase') || request()->is('page_cart') || request()->is('dealer_orders_page'))
            <a href="{{url('/page_cart')}}" style="color: #fff; text-decoration:none;"><i class="fas fa-shopping-cart" style="color: #fff;"></i></a>
        @else
            <a href="{{url('/cart')}}" style="color: #fff; text-decoration:none;"><i class="fas fa-shopping-cart" style="color: #fff;"></i> {{$cartCount}}</a>
        @endif
    </span>

    <div class="search-form">
        <form action="{{url('/search-product')}}" class="input-group" method="get" > {{csrf_field()}}
            <div class="form-group">
                <input type="text" name="query" id="searcha" class="search typeahead" placeholder="Search" required>
            </div>
            <div class="form-submit">
                <button type="submit" style="background: none;border: none;"><i  class="fas fa-search" style="color: #fff;"></i></button>
            </div>
        </form>
    </div>
    <ul class="nav-ul-first">
        @if(\Illuminate\Support\Facades\Auth::check())
            <li> <a href="{{url('dealer/account')}}">Account</a></li>

        @else
            <li> <a href="#" class="show-login">SignIn</a></li>

        @endif
            @if(request()->is('dealer-service') || request()->is('dealer-purchase') || request()->is('page_cart') || request()->is('dealer_orders_page'))
                <li><a href="{{url('/dealer_orders_page')}}">Order</a></li>
                @else
                <li><a href="{{url('/thanks')}}">Order</a></li>
                @endif

            @if(request()->is('dealer-service') || request()->is('dealer-purchase') || request()->is('page_cart') || request()->is('dealer_orders_page'))
                <li><a href="{{url('/page_cart')}}"><i class="fas fa-shopping-cart"></i></a></li>
          @else
                <li><a href="{{url('/cart')}}"><i class="fas fa-shopping-cart"></i> {{$cartCount}}</a></li>
            @endif
    </ul>
</nav>


<nav class="nav" >
    <label for="btn" class="icon"  style="z-index: 30001;">
        <span class="fa fa-bars nav-icon-now"></span>
    </label>
    <input class="nav-input" type="checkbox" id="btn">
    <ul class="nav-ul-first" style="z-index: 30000;">

        <li>
            <label for="btn-2" class="show" >Category +</label>
            <a href="#">Category</a>
            <input class="nav-input" type="checkbox" id="btn-2">

            <ul>
                @foreach($categories as $cat)
                <li>
                    <label for="btn-1{{$cat->id}}" class="show"> <a href="{{url('/products-filters/'.$cat->url)}}">{{$cat->category_name}}</a> @if(count($cat->sub_categories)) + @endif</label>
                    <a href="{{url('/products-filters/'.$cat->url)}}"> {{$cat->category_name}}  @if(count($cat->sub_categories)) <span class="fa fa-plus"> </span> @endif</a>
                    <input class="nav-input" type="checkbox" id="btn-1{{$cat->id}}">
                    @if(count($cat->sub_categories))
                    <ul>
                        @foreach($cat->sub_categories as $subcat)
                            <li> <label for="btn-2{{$subcat->id}}" class="show"><a href="{{url('/products-filters/'.$subcat->url)}}">{{$subcat->sub_category_name }}</a></label><a href="{{url('/products-filters/'.$subcat->url)}}">{{$subcat->sub_category_name }}</a>
                            <input class="nav-input" type="checkbox" id="btn-2{{$subcat->id}}">

                        </li>
                            @endforeach

                    </ul>
                        @endif
                </li>
                @endforeach
            </ul>

        </li>

        <li><a href="#">All Shop</a></li>
        <li><a href="#">Gift Card</a></li>
        <li><a href="#">Campaigns</a></li>
        <li><a href="#">Express</a></li>
        <li><a href="#" class="chairyok">All Service</a></li>
    </ul>

    <ul class="righ-bottm-menu">

        <li><a href="#">News Feed</a></li>
        <li><a href="#">Help</a></li>
        @if(\Illuminate\Support\Facades\Auth::check())
                <li><a href="#" id="profile-view">Profile</a></li>
            @if(request()->is('dealer-service') || request()->is('dealer-purchase'))
                <li><a href="#" id="dealer-view">Dealer</a></li>

            @endif
            @else
            <li class="small-show-signin show-login"><a href="#">SignIn</a></li>
        @endif


    </ul>
</nav>

<div class="center">
    <div class="countryList"></div>
</div>

<div class="center">
    <div class="dealer">
        <div class="cart">
            <div class="cart-body">

                <div class="profile-single">
                    @if($bdealerCount > 0)
                        <h5><a href="{{url('/dealer-service')}}"><i class="far fa-user razib-icon"></i> Dealer Service</a></h5>
                    @else
                        <h5><a href="#" class="you_are_not_dealer"><i class="far fa-user razib-icon"></i> Dealer Service</a></h5>

                    @endif
                </div>

                <div class="profile-single">
                    <h5><a href="#"><i class="fas fa-search razib-icon"></i> Dealer List</a></h5>
                </div>

            </div>
        </div>
    </div>
</div>

