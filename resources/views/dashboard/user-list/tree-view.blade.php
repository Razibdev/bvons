@extends('layouts.backend')

@section('css_before')
@endsection

@section('css_after')
    <style>

        .user_tree_view {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .tree_view_root li.parent-list:first-of-type {
            margin-bottom: 35px;
        }
        a.single-parent-user {
            box-shadow: 0px 0px 3px 1px #e0e4ec;
            width: 130px;
            height: 150px;
            margin-bottom: 39px;
            position: relative;
            overflow: visible;

        }
        a.single-parent-user:before {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 50%;
            height: 20px;
            width: 2px;
            background: #1b1b1b;
            transform: translateX(-50%);
        }
        li.parent-list {
            overflow-x: scroll;
        }
        .child-list {
            display: inline-flex;
            position: relative;
            margin-left: 64px;
            margin-bottom: 30px;
            align-items: flex-start;
        }
        .child-list:before {
            content: "";
            position: absolute;
            left: 0px;
            top: -20px;
            height: 2px;
            width: calc(100% - 99px);
            background: #1b1b1b;

        }
        .child-list li {
            margin-right: 35px;
            box-shadow: 0px 0px 5px 1px #c4e1fb7d;
            padding: 20px 15px;
            position: relative;
        }
        .child-list li:before {
            content: '';
            width: 2px;
            height: 20px;
            background: #060606;
            top: -20px;
            left: 50%;
            position: absolute;
            transform: translateX(-50%);
        }
        .single-user {
            overflow: hidden;
            width: 100px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .profile-avater {
            width: 80px;
            height: 80px;
            background: #ddd;
            border-radius: 50%;
        }
        .profile-name {
            font-size: 10px;
            margin-top: 10px;
        }

        ul.child-list li.parent-list {
            box-shadow: none;
            padding: 1px 1px;
            overflow: visible;
        }

        ul.child-list li.parent-list a.single-parent-user {
            height: 159px;
            box-shadow: 0px 0px 5px 1px #c4e1fb7d;
        }

        ul.child-list li.parent-list a.single-parent-user:after {
            top: -20px;
            left: 50%;
            position: absolute;
            background: #1b1b1b;
            width: 2px;
            height: 20px;
            content: '';
            overflow: visible;
        }
        ul.child-list li.parent-list:before {
            content: none;
        }
        a.single-parent-user.single-user:hover:before,
        a.single-parent-user.single-user:hover + ul.child-list:before,
        a.single-parent-user.single-user:hover + ul.child-list > li:before,
        a.single-parent-user.single-user:hover + ul.child-list li.parent-list a.single-parent-user:after{
            background: #0e91f3;
            transition: all 0.5s;
        }
    </style>
@endsection

@section('js_after')

@endsection


@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">User Tree View</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>User Tree View</small>
                </h3>
            </div>
            <div class="block-content block-content-full">

                <ul class="user_tree_view tree_view_root">

                @foreach($users as $user)
                        <li class="parent-list">
                            <a href="" class="single-parent-user single-user">
                                <div class="profile-avater"></div>
                                <div class="profile-name">{{ $user->name }}</div>
                            </a>
                            <ul class="user_tree_view child-list">
                                @foreach($user->getChildUser() as $child_u)
                                <li>
                                    <a href="" class="single-user">
                                        <div class="profile-avater"></div>
                                        <div class="profile-name">{{$child_u->name}}</div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>

                        </li>
                @endforeach
                </ul>
               {{--
               <ul class="user_tree_view tree_view_root">
                    <li class="parent-list">
                        <a href="" class="single-parent-user single-user">
                            <div class="profile-avater"></div>
                            <div class="profile-name">Parent User One And One</div>
                        </a>
                        <ul class="user_tree_view child-list">
                            <li>
                                <a href="" class="single-user">
                                    <div class="profile-avater"></div>
                                    <div class="profile-name">Child 1</div>
                                </a>
                            </li>

                            <li class="parent-list">
                                <a href="" class="single-parent-user single-user">
                                    <div class="profile-avater"></div>
                                    <div class="profile-name">Child 2</div>
                                </a>
                                <ul class="user_tree_view child-list">
                                    <li>
                                        <a href="" class="single-user">
                                            <div class="profile-avater"></div>
                                            <div class="profile-name">child-2-1</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" class="single-user">
                                            <div class="profile-avater"></div>
                                            <div class="profile-name">child-2-2</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" class="single-user">
                                            <div class="profile-avater"></div>
                                            <div class="profile-name">child-2-3</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" class="single-user">
                                            <div class="profile-avater"></div>
                                            <div class="profile-name">child-2-4</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" class="single-user">
                                            <div class="profile-avater"></div>
                                            <div class="profile-name">child-2-5</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="" class="single-user">
                                    <div class="profile-avater"></div>
                                    <div class="profile-name">Child 3</div>
                                </a>
                            </li>
                            <li>
                                <a href="" class="single-user">
                                    <div class="profile-avater"></div>
                                    <div class="profile-name">Child 4</div>
                                </a>
                            </li>
                            <li>
                                <a href="" class="single-user">
                                    <div class="profile-avater"></div>
                                    <div class="profile-name">Child 5</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                --}}


            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
@endsection
