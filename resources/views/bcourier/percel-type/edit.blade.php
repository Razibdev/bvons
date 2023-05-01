@extends('layouts.backend')
@section('ttile', 'Percel Type Edit')
@section('css_before')
@endsection

@section('css_after')

@endsection

@section('js_after')



@endsection


@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Create Percel Type</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>All User</small>
                </h3>
            </div>



            <div class="block-content block-content-full">
                <form action="{{ route('bco.percel_type.update', ["bcoPercelType" => $bcoPercelType->id]) }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="">Percel Type</label>
                        <input type="text" name="name" id="" class="form-control" placeholder="Percel Type" value="{{ $bcoPercelType->name }}">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Update Percel Type</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
@endsection
