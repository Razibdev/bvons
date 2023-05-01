@extends('layouts.front_layout.front_layout')

@push('css')
    <style>
        .nav-item.nav-link{
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
        }
        .nav-item.nav-link.active{
            background: #cae8e4;
        }
        .wallet-icon{
            font-size: 25px;
        }

        .order-title{
            padding: 15px;
            font-size: 30px;
            font-weight: 400;
        }
        .checkbox-icon{
            display: inline;
            /* margin: 20px; */
            float: left;
            margin-top: 45px;
            margin-left: -195px;
        }

        .profile-title{
            padding-left: 5px;
            color: #4a4040;
            padding-bottom: 1px;
            width: 200px;
            display: inline;
            margin-top: 40px;
            float: left;
        }
        .profile-icon{
            font-size: 20px;
            color: gray;
            padding: 3px;
        }

        .profile-title-bottom{
            font-size: 20px;
            padding:2px;
        }
        .durjoy-icon{
            font-size: 30px;
            margin-left: 63px;
            padding: 5px;
        }
        .durjoy-title{
            font-size: 18px;
            margin-left: 30px;
            padding: 10px;
        }

    </style>
@endpush
@section('content')
    <main class="main-wrapper">
        <div class="product_area_common mt-50 overflow-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-column ">
                            <div class="row" style="margin-bottom: 15px; margin-top: 15px; background: url({{asset('frontend/background.jpg')}}) no-repeat; -webkit-background-size: cover;background-size: cover; padding-top: 15px;">
                                <div class="col-md-2">
                                    @if(Auth::user()->profile_pic != '')
                                        <img class="rounded-circle" width="100" height="100" style="margin-left: 75px; margin-bottom: 10px;" alt="100x100" src="{{asset('/storage/'.\Illuminate\Support\Facades\Auth::user()->profile_pic)}}"
                                             data-holder-rendered="true">
                                    @else
                                        <img class="rounded-circle" width="100" height="100" style="margin-left: 75px; margin-bottom: 10px;" alt="100x100" src="{{ asset('css/frontend/img/logo.png') }}"
                                             data-holder-rendered="true">
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <h3 class="profile-title">{{Auth::user()->name}}</h3>
                                    <div class="round checkbox-icon">

                                        @if(\Illuminate\Support\Facades\Auth::user()->type == 'BP')
                                            <input type="checkbox" id="checkbox" checked style="margin-top: -25px; margin-left: 162px;" />
                                            <label for="checkbox" style="margin-top: -25px; margin-left: 162px;"></label>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active profile-title-bottom" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fas fa-paste profile-icon"></i> Post</a>
                                <a class="nav-item nav-link profile-title-bottom" id="nav-profile-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-exclamation profile-icon"></i> About</a>
                                <a class="nav-item nav-link profile-title-bottom" id="nav-profile-tab" data-toggle="tab" href="#nav-shipped" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-user-plus profile-icon"></i>Followers</a>
                                <a class="nav-item nav-link profile-title-bottom" id="nav-profile-tab" data-toggle="tab" href="#nav-completed" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-user-friends profile-icon"></i>Following</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <table class="table table-hover" style="background: #ffffff; margin-top: 20px; margin-bottom: 20px;" >
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Amount</th>
                                        <th>Placed</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th>01</th>
                                        <th>2000</th>
                                        <th>Pending</th>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>



                            <div class="tab-pane fade" id="nav-details" role="tabpanel" aria-labelledby="nav-profile-tab">
                              <div class="row" style="margin-top: 15px; margin-bottom: 15px;" >

                                  <div class="col-md-2">
                                      <div class="shadow p-3 mb-5 bg-white rounded">
                                          <p><i class="fas fa-user durjoy-icon"></i></p>
                                          <h4 class="durjoy-title" style="color: green;">Known As</h4>
                                          <h4 class="durjoy-title">Durjoy</h4>
                                      </div>
                                  </div>

                                  <div class="col-md-2">
                                      <div class="shadow p-3 mb-5 bg-white rounded">
                                          <p><i class="fas fa-gift durjoy-icon"></i></p>
                                          <h4 class="durjoy-title" style="color: green;">Work As</h4>
                                          <h4 class="durjoy-title">Enterpreneur</h4>
                                      </div>
                                  </div>

                                  <div class="col-md-2">
                                      <div class="shadow p-3 mb-5 bg-white rounded">
                                          <p><i class="fas fa-birthday-cake durjoy-icon"></i></p>
                                          <h4 class="durjoy-title" style="color: green;">Birthday</h4>
                                          <h4 class="durjoy-title">1993-12-16</h4>
                                      </div>
                                  </div>

                                  <div class="col-md-2">
                                      <div class="shadow p-3 mb-5 bg-white rounded">
                                          <p><i class="fas fa-venus-mars durjoy-icon"></i></p>
                                          <h4 class="durjoy-title" style="color: green;">Gender</h4>
                                          <h4 class="durjoy-title">Male</h4>
                                      </div>
                                  </div>

                                  <div class="col-md-2">
                                      <div class="shadow p-3 mb-5 bg-white rounded">
                                          <p><i class="fas fa-globe-africa durjoy-icon"></i></p>
                                          <h4 class="durjoy-title" style="color: green;">Religion</h4>
                                          <h4 class="durjoy-title">Durjoy</h4>
                                      </div>
                                  </div>

                                  <div class="col-md-2">
                                      <div class="shadow p-3 mb-5 bg-white rounded">
                                          <p><i class="fas fa-calculator durjoy-icon"></i></p>
                                          <h4 class="durjoy-title" style="color: green;">Lives In</h4>
                                          <h4 class="durjoy-title">Uttara, Dhaka</h4>
                                      </div>
                                  </div>

                                  <div class="col-md-2">
                                      <div class="shadow p-3 mb-5 bg-white rounded">
                                          <p><i class="fas fa-home durjoy-icon"></i></p>
                                          <h4 class="durjoy-title" style="color: green;">Hometown</h4>
                                          <h4 class="durjoy-title">Gajipur, Dhaka</h4>
                                      </div>
                                  </div>


                              </div>
                            </div>





                            <div class="tab-pane fade" id="nav-shipped" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <table class="table table-hover" style="background: #ffffff; margin-top: 20px; margin-bottom: 20px;" >
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Amount</th>
                                        <th>Placed</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th>01</th>
                                        <th>2000</th>
                                        <th>Shipped</th>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>

                            <div class="tab-pane fade" id="nav-completed" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <table class="table table-hover" style="background: #ffffff; margin-top: 20px; margin-bottom: 20px;" >
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Amount</th>
                                        <th>Placed</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th>01</th>
                                        <th>2000</th>
                                        <th>Completed</th>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push("js")

@endpush