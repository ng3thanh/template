@extends('admin.layout')
@section('title', 'Service list')

@section('css')
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box" style="padding:20px">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr class="header-table">
                                <th>ID</th>
                                <th>Service</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            @foreach($services as $service)
                                <tr class="body-table">
                                    <td>{{ $number++ }}</td>
                                    <td class="text-left">
                                        <a href="#" target="_blank">
                                            <span class="short-text">{{ $service->name }}</span>
                                        </a>
                                    </td>
                                    <td>
                                        <img class="img-thumbnail" src='{{ asset("$service->image") }}' width="50px" height="">
                                    </td>
                                    <td>
                                        <span class="short-text">{!! isset($service->price) ? $service->price : 'Contact' !!}</span>
                                    </td>
                                    <td>
                                        <span class="short-text">{!! $service->description !!}</span>
                                    </td>
                                    <td>
                                        {{ $service->status }}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('services.edit', $service->id) }}" type="button" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <div class="text-center"> {{ $services->links() }}</div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->


@endsection

@section('script')

@endsection
