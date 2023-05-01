@extends('layouts.front_layout.front_layout')

@push('css')
    <link rel="stylesheet" href="{{asset('/frontend/css/croppie.css')}}">
@endpush
@section('content')
    
    @if($countCart > 0)

        <div class="idcart-profile">
           <div class="profile-cart">
                <div class="single-cart">
                    <input type="text"  name="account" value="{{Auth::user()->referral_id}}" readonly id="account" placeholder="Enter Your Account Number">
                    <input type="email" readonly name="email" value="{{Auth::user()->email}}" id="email" placeholder="Enter Your Email Address">
                    <input type="phone" readonly name="phone" value="{{Auth::user()->phone}}" id="phone" placeholder="Enter Phone Number">
                    <input type="text" readonly name="blood" value="{{$countCartfirst->blood}}" id="blood" placeholder="Enter blood group">

                </div>
                <div class="single-cart">
                    <img width="200" height="200" src="{{asset('/media/cart/'.Auth::id().'/'.$countCartfirst->image)}}" alt="">
                </div>
               
              </div>
        </div>
          
        
    @else

    <div class="idcart-profile">
        <form action="{{url('/user-idcart')}}" method="post" enctype="multipart/form-data"> {{csrf_field()}}
        <div class="profile-cart">
            <div class="single-cart">
                <input type="text"  name="account" value="{{Auth::user()->referral_id}}" readonly id="account" placeholder="Enter Your Account Number">
                <input type="email" readonly name="email" value="{{Auth::user()->email}}" id="email" placeholder="Enter Your Email Address">
                <input type="phone" readonly name="phone" value="{{Auth::user()->phone}}" id="phone" placeholder="Enter Phone Number">
                <input type="text" name="blood" value="{{Auth::user()->blood}}" id="blood" placeholder="Enter blood group">

            </div>
            <div class="single-cart">
                <input type="file" id="upload_image" name="image" />
                <div id="uploaded_image"></div>
            </div>
            <div class="full-single-cart">
                <button type="submit">Save</button>
            </div>
        </div>
    </form>

    </div>
    <div id="uploadimageModal" class="modal-upload_image">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" onclick="modalCloseNow()" class="close">&times;</button>
                    <h4 class="modal-title">Upload & Crop Image</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 text-center">
                            <div id="image_demo" style="width:350px; margin-top:30px"></div>
                        </div>
                        <div class="col-md-4" style="padding-top:30px;">
                            <br />
                            <br />
                            <br/>
                            <button class="btn btn-success crop_image">Crop & Upload Image</button>
                            <button type="button" class="btn btn-default" onclick="modalCloseNow()">Close</button>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    @endif




@endsection

@push("js")
    <script src="{{asset('/frontend/js/croppie.js')}}"></script>
    <script>

        function modalCloseNow(){
            $('.modal-dialog').css('display', 'none');
        }

        $(document).ready(function(){

            $image_crop = $('#image_demo').croppie({
                enableExif: true,
                viewport: {
                    width:200,
                    height:200,
                    type:'square' //circle
                },
                boundary:{
                    width:300,
                    height:300
                }
            });

            $('#upload_image').on('change', function(){
                var reader = new FileReader();
                reader.onload = function (event) {
                    $image_crop.croppie('bind', {
                        url: event.target.result
                    }).then(function(){
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
                $('.modal-dialog').css('display', 'block');
            });

            $('.crop_image').click(function(event){
                $image_crop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(response){
                    // alert(response);
                    $.ajax({
                        url:"{{url('/user-idcart-form')}}",
                        method: "post",
                        data:{"image": response, "_token": "{{ csrf_token() }}"},
                        success:function(data)
                        {
                            console.log(data);
                            $('.modal-dialog').css('display', 'none');
                            $('#uploaded_image').html(data);
                        }
                    });
                })
            });

        });
    </script>
@endpush