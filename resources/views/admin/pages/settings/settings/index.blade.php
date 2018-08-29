@extends('admin.layout')
@section('title', 'Slides setting')

@section('css')
@endsection

@section('content')
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    Footer settings
                    <div class="pull-right">
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle" data-toggle="modal" data-target="#modal-new-footer">
                            <i class="fa fa-plus-circle"></i>
                        </button>
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle" data-toggle="modal" data-target="#modal-delete-footer">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_en" data-toggle="tab" aria-expanded="true">English</a>
                    </li>
                    <li class="">
                        <a href="#tab_vn" data-toggle="tab" aria-expanded="false">Vietnamese</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_en">
                        <div class="col-lg-4 invoice-col">
                            @foreach($footerInfo[1] as $key => $value)
                                <i class="fa fa-fw fa-{{ $value->icon }}"></i> <strong class="text-capitalize">{{ $value->name }}</strong>: <span>{{ $value->value }}</span><br>
                            @endforeach
                        </div>
                        <!-- /.col -->
                        <div class="col-lg-4 invoice-col">
                            @foreach($footerInfo[2] as $key => $value)
                                <i class="fa fa-fw fa-{{ $value->icon }}"></i> <strong class="text-capitalize">{{ $value->name }}</strong>: <span>{{ $value->value }}</span><br>
                            @endforeach
                        </div>
                        <!-- /.col -->
                        <div class="col-lg-4 invoice-col">
                            @foreach($footerInfo[3] as $key => $value)
                                <i class="fa fa-fw fa-{{ $value->icon }}"></i> <strong class="text-capitalize">{{ $value->name }}</strong>: <span>{{ $value->value }}</span><br>
                            @endforeach
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_vn">
                        <div class="col-lg-4 invoice-col">
                            @foreach($footerInfo[1] as $key => $value)
                                <i class="fa fa-fw fa-{{ $value->icon }}"></i> <strong class="text-capitalize">{{ $value->name_vn }}</strong>: <span>{{ $value->value_vn }}</span><br>
                            @endforeach
                        </div>
                        <!-- /.col -->
                        <div class="col-lg-4 invoice-col">
                            @foreach($footerInfo[2] as $key => $value)
                                <i class="fa fa-fw fa-{{ $value->icon }}"></i> <strong class="text-capitalize">{{ $value->name_vn }}</strong>: <span>{{ $value->value_vn }}</span><br>
                            @endforeach
                        </div>
                        <!-- /.col -->
                        <div class="col-lg-4 invoice-col">
                            @foreach($footerInfo[3] as $key => $value)
                                <i class="fa fa-fw fa-{{ $value->icon }}"></i> <strong class="text-capitalize">{{ $value->name_vn }}</strong>: <span>{{ $value->value_vn }}</span><br>
                            @endforeach
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="clearfix"></div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <hr>
        <!-- Table row -->
        <div class="row">
            <div class="box-body">
                <form role="form" id="update-setting" class="form-horizontal" action="{{ route('footer.update') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-xs-12">
                        @foreach($footerInfo[1] as $key => $value)
                            <div class="form-group">
                                <label class="col-lg-3 control-label text-capitalize">
                                    <i id="fa_{{ $value->name }}" class="fa fa-fw fa-{{ $value->icon }}"></i>
                                    {{ $value->name }}
                                </label>
                                <div class="col-lg-9 input-group">
                                    <div class="col-lg-12 row">
                                        <input type="text" id="{{ $value->name }}" name="{{ $value->name }}[value]" class="form-control" value="{{ $value->value }}">
                                    </div>
                                    <div class="col-lg-12 row">
                                        <input type="text" id="{{ $value->name_vi }}" name="{{ $value->name }}[value_vn]" class="form-control" value="{{ $value->value_vn }}">
                                    </div>
                                    <div class="col-lg-12 row">
                                        <select class="form-control" name="{{ $value->name }}[icon]" id="icon_{{ $value->name }}">
                                            @foreach($faIcon as $k => $v)
                                                <option value="{{ $v }}" @if($v == $value->icon) selected @endif class="text-capitalize">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="hidden" value="{{ $value->id }}" name="{{ $value->name }}[id]">
                                </div>
                            </div>
                        @endforeach
                        <hr>
                        @foreach($footerInfo[2] as $key => $value)
                            <div class="form-group">
                                <label class="col-lg-3 control-label text-capitalize">
                                    <i id="fa_{{ $value->name }}" class="fa fa-fw fa-{{ $value->icon }}"></i>
                                    {{ $value->name }}
                                </label>
                                <div class="col-lg-9 input-group">
                                    <div class="col-lg-12 row">
                                        <input type="text" id="{{ $value->name }}" name="{{ $value->name }}[value]" class="form-control" value="{{ $value->value }}">
                                    </div>
                                    <div class="col-lg-12 row">
                                        <input type="text" id="{{ $value->name_vi }}" name="{{ $value->name }}[value_vn]" class="form-control" value="{{ $value->value_vn }}">
                                    </div>
                                    <div class="col-lg-12 row">
                                        <select class="form-control" name="{{ $value->name }}[icon]" id="icon_{{ $value->name }}">
                                            @foreach($faIcon as $k => $v)
                                                <option value="{{ $v }}" @if($v == $value->icon) selected @endif class="text-capitalize">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="hidden" value="{{ $value->id }}" name="{{ $value->name }}[id]">
                                </div>
                            </div>
                        @endforeach
                        <hr>
                        @foreach($footerInfo[3] as $key => $value)
                            <div class="form-group">
                                <label class="col-lg-3 control-label text-capitalize">
                                    <i id="fa_{{ $value->name }}" class="fa fa-fw fa-{{ $value->icon }}"></i>
                                    {{ $value->name }}
                                </label>
                                <div class="col-lg-9 input-group">
                                    <div class="col-lg-12 row">
                                        <input type="text" id="{{ $value->name }}" name="{{ $value->name }}[value]" class="form-control" value="{{ $value->value }}">
                                    </div>
                                    <div class="col-lg-12 row">
                                        <input type="text" id="{{ $value->name_vi }}" name="{{ $value->name }}[value_vn]" class="form-control" value="{{ $value->value_vn }}">
                                    </div>
                                    <div class="col-lg-12 row">
                                        <select class="form-control" name="{{ $value->name }}[icon]" id="icon_{{ $value->name }}">
                                            @foreach($faIcon as $k => $v)
                                                <option value="{{ $v }}" @if($v == $value->icon) selected @endif class="text-capitalize">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="hidden" value="{{ $value->id }}" name="{{ $value->name }}[id]">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </form>

                <div class="box-footer col-xs-12" style="margin-top: 20px; padding-top: 20px">
                    <div class="col-xs-8 col-xs-offset-2">
                        <div class="col-xs-4">
                            <button class="btn btn-block btn-default" form="update-setting" type="submit">Update</button>
                        </div>
                        <div class="col-xs-offset-2 col-xs-4">
                            <button class="btn btn-block btn-default" form="update-setting" type="reset">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>

    <div class="modal fade" id="modal-new-footer">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add new footer attribute</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12">
                        <form role="form" id="add-new-footer" class="form-horizontal" action="{{ route('footer.store') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Name (en)<span class="span-red">*</span></label>
                                <div class="col-sm-9 input-group">
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Content (en) <span class="span-red">*</span></label>
                                <div class="col-sm-9 input-group">
                                    <input type="text" name="value" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Name (vi)<span class="span-red"> *</span></label>
                                <div class="col-sm-9 input-group">
                                    <input type="text" name="name_vn" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Content (vi) <span class="span-red">*</span></label>
                                <div class="col-sm-9 input-group">
                                    <input type="text" name="value_vn" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Icon <span class="span-red">*</span></label>
                                <div class="col-sm-9 input-group">
                                    <select class="form-control" name="icon">
                                        @foreach($faIcon as $k => $v)
                                            <option value="{{ $v }}" class="text-capitalize">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Type <span class="span-red">*</span></label>
                                <div class="col-sm-9 input-group">
                                    <select class="form-control" name="type">
                                        <option value="1" class="text-capitalize">Introduce</option>
                                        <option value="2" class="text-capitalize">Contact info</option>
                                        <option value="3" class="text-capitalize">Social network</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-default" form="add-new-footer">Add new</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-delete-footer">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete footer attribute</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12">
                        @foreach($footerInfo as $footer)
                            @foreach($footer as $key => $value)
                                <form role="form" class="form-horizontal" action="{{ route('footer.delete', $value->id) }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <label class="col-lg-9 text-capitalize">
                                        <i id="fa_{{ $value->name }}" class="fa fa-fw fa-{{ $value->icon }}"></i>
                                        {{ $value->name }}
                                    </label>
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></button>
                                    </div>
                                </form>
                            @endforeach
                        @endforeach
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('script')
    <script src="{{ asset('admin/js/pages/setting/setting.js') }}"></script>
    <script>
        $(function () {
            Setting.init();
        });
    </script>
@endsection
