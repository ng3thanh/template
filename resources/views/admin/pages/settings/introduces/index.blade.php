@extends('admin.layout')
@section('title', 'Introduce setting')

@section('css')
@endsection

@php
    $oldEnName = old('trans.en.name');
    $oldEnContent = old('trans.en.content');

    $nameEn = isset($oldEnName) ? $oldEnName : $introduce->translations[0]->name;
    $contentEn = isset($oldEnContent) ? $oldEnContent : $introduce->translations[0]->content;

    $oldVnName = old('trans.vi.name');
    $oldVnContent = old('trans.vi.content');

    $nameVn = isset($oldVnName) ? $oldVnName : $introduce->translations[1]->name;
    $contentVn = isset($oldVnContent) ? $oldVnContent : $introduce->translations[1]->content;
@endphp
@section('content')
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Introduce setting</h3>
            </div>
            <div class="box-body">
                <form role="form" id="update-introduce" class="form-horizontal" action="{{ route('introduce.update', [ $introduce->id ]) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-xs-12">
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
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Title <span class="span-red">*</span></label>
                                        <div class="col-sm-9 input-group">
                                            <input type="text" id="name-en" name="trans[en][name]" max="200" maxlength="200" data-rule-required="true" class="form-control" placeholder="Title ..." value="{{ $nameEn }}">
                                            @include('elements.error_line', ['attribute' => 'trans.en.name'])
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Content <span class="span-red">*</span></label>
                                        <div class="col-sm-9 input-group">
                                            <textarea class="form-control" id="content_ckediter" name="trans[en][content]" max="20000" maxlength="20000" data-rule-required="true" rows="10" cols="80">{{ $contentEn }}</textarea>
                                            @include('elements.error_line', ['attribute' => 'trans.en.content'])
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_vn">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Title <span class="span-red">*</span></label>
                                        <div class="col-sm-9 input-group">
                                            <input type="text" id="name-vn" name="trans[vi][name]" max="200" maxlength="200" class="form-control" data-rule-required="true" placeholder="Title ..." value="{{ $nameVn }}">
                                            @include('elements.error_line', ['attribute' => 'trans.vi.name'])
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Content <span class="span-red">*</span></label>
                                        <div class="col-sm-9 input-group">
                                            <textarea class="form-control" id="content_ckediter_vn" name="trans[vi][content]" max="20000" maxlength="20000" data-rule-required="true" rows="10" cols="80">{{ $contentVn }}</textarea>
                                            @include('elements.error_line', ['attribute' => 'trans.vi.content'])
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <!-- nav-tabs-custom -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"> Main image <span class="span-red">*</span></label>
                                    <div class="col-sm-9 input-group">
                                        <img class="img-thumbnail" src='{{ asset("$introduce->image") }}' width="200px" height=""><br><br>
                                        <input type="file" class="form-control" name="image">
                                        @include('elements.error_line', ['attribute' => 'image'])
                                    </div>
                                </div>

                                <div class="button-list col-lg-12">
                                    <div class="col-lg-8 col-lg-offset-2">
                                        <div class="col-lg-3">
                                            <button class="btn btn-block btn-default" form="update-introduce" type="submit">Edit</button>
                                        </div>
                                        <div class="col-lg-offset-1 col-lg-3">
                                            <button class="btn btn-block btn-default" form="update-introduce" type="reset">Reset</button>
                                        </div>
                                        <div class="col-lg-offset-1 col-lg-3">
                                            <a href="{{ route('introduce.index') }}" class="btn btn-block btn-default">Back</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.tab-content -->
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(function () {
            var contentEditor = CKEDITOR.replace( 'content_ckediter', {
                filebrowserBrowseUrl: '{{ asset('admin/ckfinder/ckfinder.html') }}',
                filebrowserImageBrowseUrl: '{{ asset('admin/ckfinder/ckfinder.html?type=Images') }}',
                filebrowserFlashBrowseUrl: '{{ asset('admin/ckfinder/ckfinder.html?type=Flash') }}',
                filebrowserUploadUrl: '{{ asset('admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                filebrowserImageUploadUrl: '{{ asset('admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                filebrowserFlashUploadUrl: '{{ asset('admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
            });
            CKFinder.setupCKEditor(contentEditor);

            var contentEditorVn = CKEDITOR.replace( 'content_ckediter_vn', {
                filebrowserBrowseUrl: '{{ asset('admin/ckfinder/ckfinder.html') }}',
                filebrowserImageBrowseUrl: '{{ asset('admin/ckfinder/ckfinder.html?type=Images') }}',
                filebrowserFlashBrowseUrl: '{{ asset('admin/ckfinder/ckfinder.html?type=Flash') }}',
                filebrowserUploadUrl: '{{ asset('admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                filebrowserImageUploadUrl: '{{ asset('admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                filebrowserFlashUploadUrl: '{{ asset('admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
            });
            CKFinder.setupCKEditor(contentEditorVn);
        });
    </script>
@endsection
