@extends('admin.layout')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="{{ asset('admin/css/morris.css') }}">
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $blogCount }}</h3>
                        <p>Blogs</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-document"></i>
                    </div>
                    <a href="{{ route('blog.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $serviceCount }}</h3>
                        <p>Services</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('services.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ $clientCount }}</h3>
                        <p>Clients</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('clients.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{ $contactCount }}</h3>
                        <p>Feedbacks</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ route('contact.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->

        {{--<div class="col-lg-12">--}}
            {{--<div class="nav-tabs-custom">--}}
                {{--<ul class="nav nav-tabs pull-right">--}}
                    {{--<li class="pull-left header"><i class="fa fa-inbox"></i> Chart</li>--}}
                {{--</ul>--}}
                {{--<div class="tab-content no-padding">--}}
                    {{--<!-- Morris chart - Sales -->--}}
                    {{--<div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<!-- /.nav-tabs-custom -->--}}
        {{--</div>--}}

        <input type="hidden" id="data-chart-blog" value="{{ $views }}">
    </section>
    <!-- /.content -->

@endsection

@section('script')
    <script src="{{ asset('admin/js/morris.min.js') }}"></script>
    {{--<script>--}}
        {{--var data = $("#data-chart-blog").val();--}}
        {{--console.log(data);--}}
        {{--Morris.Area({--}}
            {{--element: 'revenue-chart',--}}
            {{--data: [--}}
                {{--{"title": 1,"view":11},--}}
                {{--{"title": 2,"view":2},--}}
                {{--{"title": 3,"view":2},--}}
                {{--{"title": 4,"view":2},--}}
                {{--{"title": 5,"view":1}]--}}
            {{--,--}}
            {{--xkey: ['title'],--}}
            {{--ykeys: ['view'],--}}
            {{--labels: ['View']--}}
        {{--});--}}
    {{--</script>--}}
@endsection