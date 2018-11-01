@extends('admin.layout')
@section('title', 'Profile')

@section('css')
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <!-- Base Info -->
                @include('admin.pages.users.profile.components.base')
                <!-- About Me Info -->
                @include('admin.pages.users.profile.components.about')
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity-tab" data-toggle="tab">Activity</a></li>
                        <li><a href="#timeline-tab" data-toggle="tab">Timeline</a></li>
                        <li><a href="#information-tab" data-toggle="tab">Settings</a></li>
                    </ul>
                    <div class="tab-content">
                        <!-- Activity Info -->
                        @include('admin.pages.users.profile.components.activity')
                        <!-- Time line Info -->
                        @include('admin.pages.users.profile.components.timeline')
                        <!-- Information Info -->
                        @include('admin.pages.users.profile.components.info')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(function () {
            $('#inputBirthday').datepicker({
                autoclose: true
            });
        });
    </script>
@endsection
