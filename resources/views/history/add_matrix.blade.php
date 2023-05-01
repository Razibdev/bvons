@extends('layouts.pagemain')
<?php
use App\Modal\CommissionRelation;
use App\Model\Matrix;
use App\Model\MachHistory;
use App\Model\Maching;

?>
@section('css_before')

@endsection

@section('content')

    <!-- Page Content -->
    <div class="content">

        <div class="my-50">
            <h2 class="font-w700 text-black mb-10">Add Matrix</h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="block">
                    <div class="block-content block-content-full">
                        <form action="{{route('user.history.add.matrix')}}" method="post"> {{csrf_field()}}
                            <div class="form-group">
                                <label for="parent_name">Placement Person</label>
                                <select name="parent_name" id="parent_name" class="form-control">
                                    <option value="0">Choose Person</option>
                                    <option value="{{$placementu->referral_id}}">{{$placementu->name}} - {{$placementu->referral_id}}</option>
                                    @foreach($placements as $placement)
                                        @if(!empty($placement->matrices))
                                        <option  @if(isset($user->matrices->user_id)) @if($user->id == $user->matrices->user_id) hidden disabled  @endif @endif  value="{{$placement->referral_id}}">{{$placement->name}} - {{$placement->referral_id}}</option>
                                    @endif
                                   @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="user_name">Agent Person</label>
                                <select name="user_name" id="user_name" class="form-control">
                                    <option value="0">Choose Person</option>
                                    @foreach($userm as $user)
                                        <option @if(isset($user->matrices->user_id)) @if($user->id == $user->matrices->user_id) hidden disabled  @endif @endif value="{{$user->id}}-{{$user->referral_id}}"> @if(isset($user->matrices->user_id)) {{$user->matrices->user_id}} @endif  {{$user->name}}-{{$user->referral_id}}</option>
                                    @endforeach

                                </select>
                            </div>


                            <div class="form-group">
                                <button type="submit" id="form-submit-now" class="btn btn-alt-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>




    </div>
    <!-- END Page Content -->
@endsection


@section('js_after')
    <script>

       $(document).on('click', '#form-submit-now',  function () {

           setTimeout(() => {
               $('#form-submit-now').prop( "disabled", true );
       }, 1000);

       });

    </script>
@endsection

