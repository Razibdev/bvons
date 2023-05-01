@extends('ecommerce.eco_layout.main')

@section('css_before')

@endsection

@section('content')

    <!-- Page Content -->
    <div class="content">
        <!-- Bootstrap Design -->
        <h2 style="width: 50%; float: left;" class="content-heading">Matrix Tree View
        </h2>
        <div class="text-right" style="width: 50%; ">
            <form action="{{url('/matrix/user/search')}}">{{csrf_field()}}
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="query" id="query">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <?php
        $my_id = $query;
        $id = [$my_id];
        for ($i = 0; $i <= 2; $i++){
        $temp_id_index = 0;
        $divide = pow(3, $i);
        if($i == 0)
            $value = 100;
        if($i == 1)
            $value = 33;
        if($i == 2)
            $value = 11;
        ?>
        <div class="row p-3">
            <?php
            for ($d=0; $d < $divide; $d++){
            ?>

            <div style="width: <?php echo $value.'%'; ?> ; padding-left: 0px;"  class="col-<?php echo 12/$divide;?> p-1 text-center">
                <div class="shadow-lg p-2 mb-2 bg-white rounded">
                    <p>
                        <?php if($id[$d] != 0){ $user = \App\User::where('referral_id', $id[$d])->first();

                            if(isset($user->name)){
                                echo $user->name;
                            }
                        }
                        ?></p>
                    <p><?php $print_id = $id[$d]; if(isset($print_id)){ if($print_id != 0) echo $print_id; }  ?></p>
                    @if($print_id != 0)
                        <p>
                            <a href="{{url('/matrix/user/up/view/'.$print_id)}}">View Up</a> <br><br>
                            <a href="{{url('matrix/user/view/user/'.$print_id)}}">View Details</a>
                        <form action="{{url('matrix/user/delete/user/'.$print_id)}}" method="get">{{csrf_field()}}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form></p>
                    @endif

                </div>
            </div>

            <?php
            for ($p = 0; $p < 3; $p++){
                $temp_id[$temp_id_index] = fetch_left_right($p, $print_id);
                $temp_id_index++;
            }
            }
            $id = $temp_id;
            ?>
        </div>
    <?php }

    function fetch_left_right($side, $agent_id){

        if($side == 0){
            $pos = 'left_position';
        }else if($side == 1){
            $pos = 'middle_position';
        }else{
            $pos = 'right_position';
        }

        $data = \App\Model\Matrix::where('referral_id', $agent_id)->first();
        $data = json_decode(json_encode($data), true);
        if($agent_id !=0){
            return $data[$pos];
        }else{
            return 0;
        }
    }

    ?>


    <!-- END Bootstrap Design -->
    </div>
    <!-- END Page Content -->
@endsection


@section('js_after')

@endsection

