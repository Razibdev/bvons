@extends('ecommerce.eco_layout.main')

@section('css_before')
   
@endsection



@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">Slider To Product List</h2>
        </div>
        <div class="my-50 text-center">
            <h4 class="font-w700 text-black mb-10">Select Slider<h4>
            <select class="form-control" name="slider_id" id="slider_id">
                <option> --select option --</option>
            @foreach($sliders as $slider)
                <option value="{{$slider->id}}"> {{$slider->sliders_name}}</option>
            @endforeach
            </select>
        </div>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <table class="table">
  <thead>
    <tr>
      <th scope="col">#SL</th>
      <th scope="col">Product Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody id="myId">
   
  </tbody>
</table>              
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
@endsection
@section('js_after')
<script>
    $(document).ready(function() {
        $('select[name="slider_id"]').on("change", function() {
            var slider_id = $(this).val();
            var i = 1;
            var mysub;
            if (slider_id) {
                 console.log(slider_id);
                $.ajax({
                    type: "GET",
                    url: "{{url('/slider/details/')}}/" + slider_id,
                    dataType: 'json',
                    success: function(data) {
                         $("#myId").empty();
                       $.each(data, function(key, value) {
                    $("#myId").append(`<tr >
                        <td> ${i++}</td>
                        <td> ${value.product_name}</td>
                        <td> ${value.slider_id}</td>
                        <td> <a href="{{url('/sliderDetails/delete/')}}/${value.id}">Delete</a></td>
                    </tr>`)
                        });
                    }
                });
            } 
        });
    });


</script>
@endsection