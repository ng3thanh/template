@extends('admin.layout')

@section('title', 'Logo setting')

@section('css')
@endsection

@section('content')
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Logo setting</h3>
                <div class="box-tools pull-right required-text-box">
                    <span class="span-red">(*): The attribute must be required</span>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="box-body">
                        <form role="form" id="logo-settings" class="form-horizontal" action="{{ route('logo.update') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Brand <span class="span-red">*</span></label>
                                        <div class="col-sm-9 input-group">
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Company label" value="{{ $logo->name or '' }}">
                                            @include('elements.error_line', ['attribute' => 'name'])
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Content 1 <span class="span-red">*</span></label>
                                        <div class="col-sm-9 input-group">
                                            <input type="text" id="content1" name="content1" class="form-control" value="{{ $logo->content1 or '' }}">
                                            @include('elements.error_line', ['attribute' => 'content1'])
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Content 2 <span class="span-red">*</span></label>
                                        <div class="col-sm-9 input-group">
                                            <input type="text" id="content2" name="content2" class="form-control" value="{{ $logo->content2 or '' }}">
                                            @include('elements.error_line', ['attribute' => 'content2'])
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Content 3 <span class="span-red">*</span></label>
                                        <div class="col-sm-9 input-group">
                                            <input type="text" id="content3" name="content3" class="form-control" value="{{ $logo->content3 or '' }}">
                                            @include('elements.error_line', ['attribute' => 'content3'])
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Logo <span class="span-red">*</span></label>
                                        <div class="col-sm-9 input-group">
                                            @if(isset($logo->image))
                                                <img class="img-thumbnail" src='{{ asset("$logo->image") }}' width="200px" height=""><br><br>
                                            @endif
                                            <input type="file" class="form-control" name="image">
                                            @include('elements.error_line', ['attribute' => 'image'])
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Favicon <span class="span-red">*</span></label>
                                        <div class="col-sm-9 input-group">
                                            @if(isset($logo->favicon))
                                                <img class="img-thumbnail" src='{{ asset("$logo->favicon") }}' width="50px" height=""><br><br>
                                            @endif
                                            <input type="file" class="form-control" name="favicon">
                                            @include('elements.error_line', ['attribute' => 'favicon'])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="box-footer col-xs-12" style="margin-top: 20px; padding-top: 20px">
                            <div class="col-xs-8 col-xs-offset-2">
                                <div class="col-xs-3">
                                    <button class="btn btn-block btn-default" form="logo-settings" type="submit">Update</button>
                                </div>
                                <div class="col-xs-offset-1 col-xs-3">
                                    <button class="btn btn-block btn-default" form="logo-settings" type="reset">Reset</button>
                                </div>
                                <div class="col-xs-offset-1 col-xs-3">
                                    <a href="{{ route('logo.index') }}" class="btn btn-block btn-default">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
