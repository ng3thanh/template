@extends('admin.layout')

@section('title', 'Edit service')

@section('css')
@endsection

@php
    $oldEnName = old('trans.en.title');
    $oldEnSlug = old('trans.en.slug');
    $oldEnDescription = old('trans.en.description');
    $oldEnContent = old('trans.en.content');

    $nameEn = isset($oldEnName) ? $oldEnName : $service->translations[0]->name;
    $slugEn = isset($oldEnSlug) ? $oldEnSlug : $service->translations[0]->slug;
    $descriptionEn = isset($oldEnDescription) ? $oldEnDescription : $service->translations[0]->description;
    $contentEn = isset($oldEnContent) ? $oldEnContent : $service->translations[0]->content;

    $oldVnName = old('trans.vi.title');
    $oldVnSlug = old('trans.vi.slug');
    $oldVnDescription = old('trans.vi.description');
    $oldVnContent = old('trans.vi.content');

    $nameVn = isset($oldVnName) ? $oldVnName : $service->translations[1]->name;
    $slugVn = isset($oldVnSlug) ? $oldVnSlug : $service->translations[1]->slug;
    $descriptionVn = isset($oldVnDescription) ? $oldVnDescription : $service->translations[1]->description;
    $contentVn = isset($oldVnContent) ? $oldVnContent : $service->translations[1]->content;
@endphp

@section('content')
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Edit service</h3>
                <div class="box-tools pull-right required-text-box">
                    <span class="span-red">(*): The attribute must be required</span>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="box-body">
                        <form role="form" id="edit-service" class="form-horizontal" action="{{ route('services.update', [ $service->id ]) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field("PUT") }}
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
                                            <label class="col-sm-3 control-label"> Service <span class="span-red">*</span></label>
                                            <div class="col-sm-9 input-group">
                                                <input type="text" id="name-en" data-rule-required="true" name="trans[en][name]" class="form-control" placeholder="Service name" value="{{ $nameEn }}">
                                                @include('elements.error_line', ['attribute' => 'trans.en.name'])
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"> Slug <span class="span-red">*</span></label>
                                            <div class="col-sm-9 input-group">
                                                <input type="text" id="slug-en" data-rule-required="true" name="trans[en][slug]" class="form-control" value="{{ $slugEn }}">
                                                @include('elements.error_line', ['attribute' => 'trans.en.slug'])
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"> Description <span class="span-red">*</span></label>
                                            <div class="col-sm-9 input-group">
                                                <textarea class="form-control" data-rule-required="true" id="des_ckediter" name="trans[en][description]" rows="8" cols="80">{{ $descriptionEn }}</textarea>
                                                @include('elements.error_line', ['attribute' => 'trans.en.description'])
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"> Content <span class="span-red">*</span></label>
                                            <div class="col-sm-9 input-group">
                                                <textarea class="form-control" data-rule-required="true" id="content_ckediter" name="trans[en][content]" rows="10" cols="80">{{ $contentEn }}</textarea>
                                                @include('elements.error_line', ['attribute' => 'trans.en.content'])
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_vn">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"> Service <span class="span-red">*</span></label>
                                            <div class="col-sm-9 input-group">
                                                <input type="text" data-rule-required="true" id="name-vi" name="trans[vi][name]" class="form-control" placeholder="Service name" value="{{ $nameVn }}">
                                                @include('elements.error_line', ['attribute' => 'trans.vi.name'])
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"> Slug <span class="span-red">*</span></label>
                                            <div class="col-sm-9 input-group">
                                                <input type="text" data-rule-required="true" id="slug-vi" name="trans[vi][slug]" class="form-control" value="{{ $slugVn }}">
                                                @include('elements.error_line', ['attribute' => 'trans.vi.slug'])
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"> Description <span class="span-red">*</span></label>
                                            <div class="col-sm-9 input-group">
                                                <textarea class="form-control" data-rule-required="true" id="des_ckediter_vn" name="trans[vi][description]" rows="8" cols="80">{{ $descriptionVn }}</textarea>
                                                @include('elements.error_line', ['attribute' => 'trans.vi.description'])
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"> Content <span class="span-red">*</span></label>
                                            <div class="col-sm-9 input-group">
                                                <textarea class="form-control" data-rule-required="true" id="content_ckediter_vn" name="trans[vi][content]" rows="10" cols="80">{{ $contentVn }}</textarea>
                                                @include('elements.error_line', ['attribute' => 'trans.vi.content'])
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->

                                    <!-- nav-tabs-custom -->
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Main image <span class="span-red">*</span></label>
                                        <div class="col-sm-9 input-group">
                                            <img class="img-thumbnail" src='{{ asset("$service->image") }}' width="200px" height=""><br><br>
                                            <input type="file" class="form-control" name="image">
                                            @include('elements.error_line', ['attribute' => 'image'])
                                        </div>
                                    </div>

                                    <div class="button-list col-lg-12">
                                        <div class="col-lg-8 col-lg-offset-2">
                                            <div class="col-lg-3">
                                                <button class="btn btn-block btn-default" form="edit-service" type="submit">Update</button>
                                            </div>
                                            <div class="col-lg-offset-1 col-lg-3">
                                                <button class="btn btn-block btn-default" form="edit-service" type="reset">Reset</button>
                                            </div>
                                            <div class="col-lg-offset-1 col-lg-3">
                                                <a href="{{ route('services.index') }}" class="btn btn-block btn-default">Back</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-content -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(function () {
            var titleEn = $("#name-en");
            var slugEn = $("#slug-en");
            var titleVn = $("#name-vi");
            var slugVn = $("#slug-vi");

            CKEDITOR.replace('des_ckediter');
            CKEDITOR.replace('des_ckediter_vn');

            var contentEditor = CKEDITOR.replace( 'content_ckediter', {
                filebrowserBrowseUrl: '{{ asset('admin/ckfinder/ckfinder.html') }}',
                filebrowserImageBrowseUrl: '{{ asset('admin/ckfinder/ckfinder.html?type=Images') }}',
                filebrowserFlashBrowseUrl: '{{ asset('admin/ckfinder/ckfinder.html?type=Flash') }}',
                filebrowserUploadUrl: '{{ asset('admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                filebrowserImageUploadUrl: '{{ asset('admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                filebrowserFlashUploadUrl: '{{ asset('admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
            });

            var contentEditorVn = CKEDITOR.replace( 'content_ckediter_vn', {
                filebrowserBrowseUrl: '{{ asset('admin/ckfinder/ckfinder.html') }}',
                filebrowserImageBrowseUrl: '{{ asset('admin/ckfinder/ckfinder.html?type=Images') }}',
                filebrowserFlashBrowseUrl: '{{ asset('admin/ckfinder/ckfinder.html?type=Flash') }}',
                filebrowserUploadUrl: '{{ asset('admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                filebrowserImageUploadUrl: '{{ asset('admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                filebrowserFlashUploadUrl: '{{ asset('admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
            });

            CKFinder.setupCKEditor(contentEditor);
            CKFinder.setupCKEditor(contentEditorVn);

            FormUtil.validate('#edit-service');
            slugCommon.convertSlug(titleEn, slugEn);
            slugCommon.convertSlug(titleVn, slugVn);
        });
    </script>
@endsection
