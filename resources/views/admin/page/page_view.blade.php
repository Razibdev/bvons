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
            <h2 class="font-w700 text-black mb-10">Bdealer Product Stock</h2>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="block">
                    <div class="block-content block-content-full">
                        <table class="table table-bordered" id="dealer-product-stock-active">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Admin</th>
                                <th>Sub Admin</th>
                                <th>Page Name</th>
                                <th>Category Name</th>
                                <th>Page Description</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($pages as $page)
                               @php

                               $admin = $page->admin_id;
                               $admin_id = explode(",", $admin);
                               for ($i = 0; $i< count($admin_id); $i++){
                              $page_admins[$i] =  \App\User::where('id', $admin_id[$i])->first();
                               }
                              foreach ($page_admins as $page_admin){
                               $admin_page[] =  $page_admin->name;
                              }
                               $show_admin_page = implode(", ", $admin_page);


                                 $subAdmin = $page->sub_admin_id;
                               $sub_admin_id = explode(",", $subAdmin);
                               for ($i = 0; $i< count($sub_admin_id); $i++){
                              $page_sub_admins[$i] =  \App\User::where('id', $sub_admin_id[$i])->first();
                               }
                              foreach ($page_sub_admins as $page_sub_admin){
                               $sub_admin_page[] =  $page_sub_admin->name;
                              }
                               $show_sub_admin_page = implode(", ", $sub_admin_page);

                               @endphp
                                <tr>
                                    <td>{{$page->id}}</td>
                                    <td>{{$show_admin_page}}</td>
                                    <td>{{$show_sub_admin_page}}</td>
                                    <td>{{$page->page_name}}</td>
                                    <td>{{$page->category_name}}</td>
                                    <td>{{\Illuminate\Support\Str::substr($page->page_description, 0, 100)}}</td>
                                    <td><img width="100" height="75" src="{{asset('media/page/'.$page->image)}}" alt=""></td>
                                    <td><a href="{{route('page.page.edit', $page->id)}}">Edit</a>&nbsp; &nbsp;<form
                                                action="{{route('page.page.delete', $page->id)}}" method="post"> {{csrf_field()}}
                                            <button style="border: none;" type="submit">Delete</button>
                                        </form></td>
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
