@extends('ecommerce.eco_layout.main')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">Brand List</h2>
        </div>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <table class="table table-bordered table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Brand Name</th>
                                <th>Sub Category Name</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($brands as $brand)

                            <tr>
                                <td class="">

                                    <img class="ku-thumbnail" src="{{asset('/storage/')}}/{{$brand->brand_image}}" alt="">

                                </td>
                                <!-- <td class="text-center">1</td> -->
                                <td class="d-none d-sm-table-cell">{{$brand->name}}</td>
                                <td class="d-none d-sm-table-cell">{{$brand->sub_category->sub_category_name}}</td>

                                <td>
                                    <a class="btn btn-alt-success btn-block"  href="{{ route('brands.edit',$brand->id) }}">Edit</a>
                                    {{--<form action="{{ route('brands.destroy',$brand->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>--}}
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
@endsection
