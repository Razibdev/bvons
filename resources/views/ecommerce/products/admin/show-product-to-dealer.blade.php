@extends('ecommerce.eco_layout.main')

@section('css_before')

@endsection

@section('js_after')
    <script>
        $('#pullProduct').on('select2:select', async function(){
            let url = "{{ route('ajaxGetProduct') }}";
            url += "?cat_id=" + $(this).val();
            let products = (await axios.get(url)).data;

            let output = `<table class="table table-bordered">
                   <tr>
                        <td>#</td>
                        <td>Name</td>
                    </tr>
            `;
            console.log(products.length);
            if(products.length) {
                for(product of products) {
                    console.log(product);
                    output += `
                    <tr>
                        <td>
                            <input type="hidden"  value="0" name="showToDealer[${product.id}]">
                            <input type="checkbox" ${product.show_to_dealers === 1 ? "checked" : ""} value="1" name="showToDealer[${product.id}]">
                        </td>
                        <td>${product.product_name}</td>
                    </tr>
                `;
                }

                output += `<tr>
                    <td colspan="2"><input type="submit" value="Submit" class="btn btn-alt-primary float-right"></td>
                </tr>`;

            } else {
                output += `<tr><td colspan="2">No Product Found</td></tr>`;
            }
            output += `</table>`;

            $('#addDealerProduct').html(output);

        });
    </script>

@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="">Show Product To Dealer</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    {{--<a href="" class="btn btn-alt-primary">
                        <i class="si si-plus"></i> Total Verified Today
                    </a>--}}
                    Add Product To Dealer
                </h3>
            </div>
            <div class="block-content block-content-full">
                <div class="form-group">
                    <label for="">Select Category</label>
                    <select name="" id="pullProduct" class="js-select2 form-control">
                        <option value="">Please Select One</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <form action="{{ route('products.update-product-to-dealer') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div id="addDealerProduct">

                    </div>
                </form>


            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
@endsection
