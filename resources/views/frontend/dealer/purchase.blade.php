@extends('layouts.front_layout.front_layout')

@push('css')
    <style>
      .product-title{
          font-size: 30px;
          padding: 10px;
          font-weight: bold;
      }

        .single-product{
            margin-top: 10px;
            border-radius: 4px;
            width: 100%;
            background: #ffffff;
            padding: 10px;
            margin-bottom: 10px;
        }
        .single-product h3{
            padding: 10px;
            font-size: 17px;
        }
    </style>
@endpush
@section('content')
    <div class="dealer-purchase">


        <div class="tab-c">
            <div class="tabs-header">
                @foreach($categories as $key => $category)
                <div class= "categoryFilter @if($key == 0) active @endif " data-id="{{$category->id}}" >
                    <img src="{{asset('/storage/'.$category->categories_image)}}" alt="">
                    <h3>{{$category->category_name}}</h3>
                </div>
                @endforeach

            </div>

            <div class="tab-content newproductnow">

            </div>

        </div>
    </div>
@endsection

@push("js")

    <script>
        let tabsHeight = document.getElementsByClassName("tabs-header")[0];
        let suppermain = document.getElementsByClassName("tab-c")[0];
        let supperContent = document.getElementsByClassName("tab-content")[0];

        let contentAll = supperContent.children;

        let contentHeight = supperContent.offsetHeight;

        let firstnowmain = document.getElementsByClassName("dealer-purchase")[0];

        const allBox=tabsHeight.children;

        let mainHeight = allBox[0].offsetHeight;


        var valuenow = 0;

        for(let i = 0; i<= allBox.length; i++){
            var nowValue = valuenow + (mainHeight *i) + 250;
            var okHeight = mainHeight *i;
            suppermain.style.setProperty('height', nowValue+"px");
            tabsHeight.style.setProperty('height', nowValue +"px");
            firstnowmain.style.setProperty('height', nowValue+"px");
        }

    </script>
    <script>
        $(document).ready(function () {
            $(document).on('click','.categoryFilter', function () {
                var id = $(this).data('id');
                $.ajax({
                    url:"/dealer-product-filter",
                    method:'get',
                    data:{
                        'id':id
                    },
                    success:function (res) {
                            var html = '<div class="active">';
                            var i = -1;
                            $.each(res, function (index, productPrice) {
                                while( i < index){
                                    html += '<div class="product-single"><img src="/storage/'+productPrice.media.product_image+'" alt=""><h3>'+productPrice.product_name +'</h3><h4>Price: Tk '+productPrice.purchase_price+'</h4><h5>Minimum Purchases:  '+productPrice.minimum_quantity+'</h5><button type="button" class="btn cartButton" data-product_id="'+productPrice.product_id+'" data-qty="'+productPrice.minimum_quantity+'" data-price="'+productPrice.purchase_price+'" data-product_name="'+productPrice.product_name+'"><i class="fas fa-plus-square" data-id="'+productPrice.id+'"></i></button></div>';
                                    i++;

                                }

                            });
                            html += '</div>';

                            $(".newproductnow").html(html);


                        }

                })
            });
        });










        $(document).ready(function(){
            $(document).on('click', '.cartButton', function () {
                var ele = $(this);
                var product_id = ele.data('product_id');
                var product_qty = ele.data('qty');
                var product_price = ele.data('price');
                var product_name = ele.data('product_name');

                $.ajax({
                    dataType:'json',
                    type:"get",
                    url: "{{url('/ajax-add_cart')}}",
                    data:{'id': product_id, 'qty': product_qty, 'price': product_price, 'name': product_name},
                    success:function(res){
                        alert('Product add to the cart');

                    }
                })
            });
        });


    </script>
@endpush



