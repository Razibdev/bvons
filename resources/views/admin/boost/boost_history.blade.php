@extends('ecommerce.eco_layout.main')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-countdown/jquery.countdown.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>

    <script>
        $(function() {
            $('#dealer-product-stock-active').DataTable();
        });


    </script>


@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="my-50">
            <h2 class="font-w700 text-black mb-10">View Boost History</h2>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="block">
                    <div class="block-content block-content-full">
                        <table style="width: 100% !important; margin-top: 10px; margin-bottom: 10px " class="table table-striped table-bordered">
                            <thead  style="height: 50px;">
                            <tr >
                                <th>ID</th>
                                <th>Author Name</th>
                                <th>Boost Type</th>
                                <th>Page Name</th>
                                <th>Budget</th>
                                <th>Audience</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody style="width: 100% !important; text-align: center">
                            <?php $i = 1; ?>
                            @foreach($boosts  as $boost)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$boost->user->name}}</td>
                                    <td>{{$boost->boost->boost_name}}</td>
                                    <td>{{$boost->page->page_name}}</td>
                                    <td>{{$boost->budget}}</td>
                                    <td>{{$boost->audience_number}}</td>
                                    <td>
                                        <a href="#">View History</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
