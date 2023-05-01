@extends('ecommerce.eco_layout.main')

@section('css_before')

@endsection

@section('content')

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Matrix Down Line</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Matrix Down Line</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Matrix Down Line</h4>

                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="datatable table table-stripped mb-0">
                                <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Account</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $i=1; @endphp
                                @foreach($matrices as $matrix)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td><a href="{{url('/matrix/user/line?users='.$matrix->user->referral_id)}}">{{$matrix->user->referral_id}}</a></td>
                                    <td>{{$matrix->user->name}}</td>
                                    <td>{{$matrix->user->phone}}</td>
                                </tr>
                                    @php $i++; @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- END Page Content -->
@endsection


@section('js_after')

@endsection

