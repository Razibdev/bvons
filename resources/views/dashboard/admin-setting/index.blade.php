@extends('layouts.backend')

@section('css_before')
@endsection

@section('css_after')
    <style>
        *[contenteditable]:focus {
            color: deepskyblue;
            font-size: 16px;
        }
    </style>
@endsection

@section('js_after')
    <script>
        window.adminSettings = {!! $admin_settings !!};
        window.settingUpdateUrl = "{!! route('admin.setting.update') !!}";
    </script>
    <script src="{{ asset('/js/pages/admin_settings.js') }}"></script>
@endsection


@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Admin Setting</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>Change Setting</small>
                </h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table id="adminSettings" class="table table-bordered table-striped admin-setting-table">
                    <thead>
                        <tr v-if="settings.length > 0" v-for="setting in settings">
                            <td class="font-weight-bold">
                                @{{ setting.setting_name }}
                            </td>

                            <td class="vertical-align-middle">
                                <span
                                    contenteditable="true"
                                    class="mr-5 admin-change-setting"
                                    v-bind:name="setting.setting_name"
                                    @blur="changeAdminSettings"
                                    v-text="setting.setting_value !== null ? setting.setting_value : setting.setting_default_value"
                                >
                                </span>
                                <i class="fa fa-pencil pull-right"></i>
                            </td>
                        </tr>

                        <tr v-else>
                            <td>No Settings Found</td>
                        </tr>

                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
@endsection
