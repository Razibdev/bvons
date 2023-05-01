@extends('layouts.backend')

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

    <script>
        $(document).on('click', '.sellnowok', function () {
            let id = $(this).data('id');
            let value;
            if($(this).is(":checked")){
                value = 1;
            }else{
                value = 0;
            }

            $.ajax({
                dataType: 'json',
                type:"get",
                url: "{{url('/dashboard/admin_setting/doctor-member-sell')}}",
                data:{'id':id, 'value':value},
                success:function(data){
                    window.location = '/dashboard/admin_setting/doctor-member-pin-generate';
                }
            });
        });
    </script>
@endsection


@section('content')

    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Used Doctor Member PinCode <small></small></h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 10%;">#</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Doctor Member Pin Code</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Type</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Name</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Account</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Sell</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pincodes as $code)
                        <tr>
                            <td class="text-center">{{$code->id}}</td>
                            <td class="font-w600">
                                {{$code->pincode}}
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <em class="text-muted">{{$code->type}}</em>
                            </td>
                            <td>{{$code->name}}</td>
                            <td>{{$code->account}}</td>
                            <td><input type="checkbox" @if($code->sold ==1) checked @endif name="sell" data-id="{{$code->id}}" class="sellnowok" value="1"></td>
                            <td>{{$code->updated_at->diffForHumans()}}</td>
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
