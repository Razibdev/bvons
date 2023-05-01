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
                url: "{{url('/dashboard/admin_setting/sell')}}",
                data:{'id':id, 'value':value},
                success:function(data){
                    window.location = '/dashboard/admin_setting/pin-generate';
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
                <h3 class="block-title">Renew Doctor Service PinCode <small></small></h3>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>Pin Code</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Type</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Month</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Name</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Account</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Date</th>
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
                        <td>@if($code->month == 1) <spn>One Month</spn> @elseif($code->month == 3) <span>Three Month</span> @elseif($code->month == 6) <span>Six Month</span> @elseif($code->month) <span>One Year</span> @endif</td>
                        <td>{{$code->name}}</td>
                        <td>{{$code->account}}</td>
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
