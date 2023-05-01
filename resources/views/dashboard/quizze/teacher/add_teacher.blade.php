@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('css_after')

@endsection

@section('js_after')
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection


@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">New Quizze Teacher</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>Bvon new Quizze Teacher</small>
                </h3>
            </div>
            <div class="block-content block-content-full">

                <form action="{{route('bvon.quizze.add.teacher')}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="referred_id">Referred By</label>
                        <select name="referred_id" id="referred_id" required class="js-select2 form-control" required>
                            <option value="">Choose Account</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}-{{$user->referral_id}}">{{$user->name}} - {{$user->referral_id}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-lg btn-alt-success">Submit</button>
                    </div>
                </form>


            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
@endsection
