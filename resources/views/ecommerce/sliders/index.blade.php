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
                            <th class="d-none d-sm-table-cell" style="width: 30%;">Type</th>
                            <th style="width: 15%;">Status</th>
                            <th style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($sliders as $slider)
                       
                        <tr>
                         <td class="avatar">
                        <div class="round-img">
                          <a href="#"><img class="rounded-circle" src="{{asset('/storage/')}}/{{$slider->sliders_image	}}" alt="" height="100"></a>
                        </div>
                      </td>
                            <!-- <td class="text-center">1</td> -->
                            <td class="d-none d-sm-table-cell">
                                <em class="text-muted">{{$slider->sliders_name}}</em>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <em class="text-muted">{{$slider->sliders_type}}</em>
                            </td>
                           
                            <td>
                                <em class="text-muted"> 
                                @php
                                if($slider->sliders_status==1){
							                  echo "Show";
							                }
							                else{
							                  echo "Hidden";
							                }
                                            @endphp
                                            </em>
                            </td>

                            <td>
                            <a class="btn btn-success"  href="{{ route('slider.edit',$slider->id) }}">Edit</a>
                <form action="{{ route('slider.destroy',$slider->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
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
