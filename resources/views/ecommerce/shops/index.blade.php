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
            <h2 class="font-w700 text-black mb-10">Shop List</h2>
        </div>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">Image</th>
                            <th>Name</th>
                            <th class="d-none d-sm-table-cell" style="width: 30%;">Address</th>
                            <th style="width: 15%;">Status</th>
                            <th style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($shops as $shop)

                        <tr>
                         <td class="avatar">
                        <div class="round-img">
                          <a href="#"><img class="rounded-circle" src="{{asset('/storage/')}}/{{$shop->shop_image	}}" alt="" height="100"></a>
                        </div>
                      </td>
                            <td class="d-none d-sm-table-cell">
                                <em class="text-muted">{{$shop->shop_name}}</em>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <em class="text-muted">{{$shop->shop_address}}</em>
                            </td>
                            <td>
                                @php
                                    if($shop->status==0){
                                      echo "Pending";
                                    }
                                    else{
                                      echo "Active";
                                    }
                                @endphp
                            </td>
                            <td><a class="btn btn-alt-success btn-block"  href="{{ route('shops.edit',$shop->id) }}">Edit</a></td>
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
