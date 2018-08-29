@extends('admin.layout')

@section('title', 'Edit client')

@section('css')
@endsection

@php
    $oldName = old('name');
    $name = isset($oldName) ? $oldName : $client->name;
@endphp

@section('content')
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Edit client</h3>
                <div class="box-tools pull-right required-text-box">
                    <span class="span-red">(*): The attribute must be required</span>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="box-body">
                        <form role="form" id="edit-client" class="form-horizontal" action="{{ route('clients.update', [ $client->id ]) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field("PUT") }}
                            <div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Service <span class="span-red">*</span></label>
                                        <div class="col-sm-9 input-group">
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Service name" value="{{ $name }}">
                                            @include('elements.error_line', ['attribute' => 'name'])
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Main image <span class="span-red">*</span></label>
                                        <div class="col-sm-9 input-group">
                                            <img class="img-thumbnail" src='{{ asset("$client->image") }}' width="200px" height=""><br><br>
                                            <input type="file" class="form-control" name="image">
                                            @include('elements.error_line', ['attribute' => 'image'])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="box-footer col-xs-12" style="margin-top: 20px; padding-top: 20px">
                            <div class="col-xs-8 col-xs-offset-2">
                                <div class="col-xs-3">
                                    <button class="btn btn-block btn-default" form="edit-client" type="submit">Update</button>
                                </div>
                                <div class="col-xs-offset-1 col-xs-3">
                                    <button class="btn btn-block btn-default" form="edit-client" type="reset">Reset</button>
                                </div>
                                <div class="col-xs-offset-1 col-xs-3">
                                    <a href="{{ route('clients.index') }}" class="btn btn-block btn-default">Back</a>
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
