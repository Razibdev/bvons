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
            <h2 class="font-w700 text-black mb-10">View Boost Type</h2>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="block">
                    <div class="block-content block-content-full">
                        <table class="table table-bordered" id="dealer-product-stock-active">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Boost Name</th>

                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($boosts as $boost)

                                <tr>
                                    <td>{{$boost->id}}</td>
                                    <td>{{$boost->boost_name}}</td>
                                    <td>
                                        <div class="input-group">
                                        <a href="{{route('boost.type.edit.type', $boost->id)}}">Edit</a>&nbsp; &nbsp;<form
                                                action="{{route('boost.type.delete.type', $boost->id)}}" method="post"> {{csrf_field()}}
                                            <button style="border: none;" type="submit">Delete</button>
                                        </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
