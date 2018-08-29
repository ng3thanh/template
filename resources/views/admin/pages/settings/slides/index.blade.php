@extends('admin.layout')
@section('title', 'Slides setting')

@section('css')
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
                <!-- MAP & BOX PANE -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Slides show - @if($slideShow) {{ $slideShow->alt }} @endif</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-default btn-sm checkbox-toggle" data-toggle="modal" data-target="#modal-new-slide">
                                <i class="fa fa-plus-circle"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pad">
                                    <!-- Map will be created here -->
                                    <div id="world-map-markers">
                                        @if($slideShow)
                                            <img src='{{ asset("$slideShow->image") }}' alt="{{ $slideShow->alt }}" width="100%">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

            <div class="col-md-4">
                <!-- Info Boxes Style 2 -->
                @foreach($slideNotShow as $slide)
                <div class="info-box">
                    <span class="info-box-icon">
                        <img class="img-fluid img-thumbnail" src='{{ asset("$slide->image") }}' alt="{{ $slide->alt }}" width="100%">
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">
                            <strong>{{ $slide->alt }}</strong>
                            <div class="box-tools pull-right">
                                <a href="{{ route('slide.choose', $slide->id) }}" class="btn btn-default btn-sm checkbox-toggle">
                                    <i class="fa fa-hand-pointer-o"></i>
                                </a>
                            </div>
                        </span>
                        <span class="info-box-more">
                            Created at: {{ timeElapsedString($slide->created_at) }}
                        </span>
                        <span class="info-box-more">
                            Deleted at: {{ timeElapsedString($slide->deleted_at) }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                @endforeach
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

    <div class="modal fade" id="modal-new-slide">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Create new slide</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12">
                        <form role="form" id="create-new-slide" class="form-horizontal" action="{{ route('slide.store') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Slide name <span class="span-red">*</span></label>
                                <div class="col-sm-9 input-group">
                                    <input type="text" name="alt" class="form-control" placeholder="Name of image ..." value="{{ old('alt') }}">
                                    @include('elements.error_line', ['attribute' => 'title'])
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Slide file <span class="span-red">*</span></label>
                                <div class="col-sm-9 input-group">
                                    <input type="file" class="form-control" name="image">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-default" form="create-new-slide">Save changes</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('script')

@endsection
