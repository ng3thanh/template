@extends('admin.layout')

@section('title', 'Edit blog')

@section('css')
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap-tagsinput.css') }}">
@endsection

@php
    $oldEnTitle = old('trans.en.title');
    $oldEnSlug = old('trans.en.slug');
    $oldEnDescription = old('trans.en.description');
    $oldEnContent = old('trans.en.content');
    $oldEnTags = old('trans.en.tags');

    $titleEn = isset($oldEnTitle) ? $oldEnTitle : $blog->translations[0]->title;
    $slugEn = isset($oldEnSlug) ? $oldEnSlug : $blog->translations[0]->slug;
    $descriptionEn = isset($oldEnDescription) ? $oldEnDescription : $blog->translations[0]->description;
    $contentEn = isset($oldEnContent) ? $oldEnContent : $blog->translations[0]->content;
    $tagEn = isset($oldEnTags) ? $oldEnTags : $blog->translations[0]->tags;

    $oldVnTitle = old('trans.vi.title');
    $oldVnSlug = old('trans.vi.slug');
    $oldVnDescription = old('trans.vi.description');
    $oldVnContent = old('trans.vi.content');
    $oldVnTags = old('trans.vn.tags');

    $titleVn = isset($oldVnTitle) ? $oldVnTitle : $blog->translations[1]->title;
    $slugVn = isset($oldVnSlug) ? $oldVnSlug : $blog->translations[1]->slug;
    $descriptionVn = isset($oldVnDescription) ? $oldVnDescription : $blog->translations[1]->description;
    $contentVn = isset($oldVnContent) ? $oldVnContent : $blog->translations[1]->content;
    $tagVn = isset($oldVnTags) ? $oldVnTags : $blog->translations[1]->tags;
@endphp
@section('content')
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit blog</h3>
            </div>
            <div class="box-body">
                <form role="form" id="update-blog" class="form-horizontal" action="{{ route('blog.update', [ $blog->id ]) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field("PUT") }}
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
                                            <input type="text" id="title-en" name="trans[en][title]" maxlength="200" data-rule-required="true" class="form-control" placeholder="Title ..." value="{{ $titleEn }}">
                                            @include('elements.error_line', ['attribute' => 'trans.en.title'])
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Slug <span class="span-red">*</span></label>
                                        <div class="col-sm-9 input-group">
                                            <input type="text" id="slug-en" name="trans[en][slug]" maxlength="200" data-rule-required="true" class="form-control" value="{{ $slugEn }}">
                                            @include('elements.error_line', ['attribute' => 'trans.en.slug'])
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Description <span class="span-red">*</span></label>
                                        <div class="col-sm-9 input-group">
                                            <textarea class="form-control" id="des_ckediter" name="trans[en][description]" maxlength="1000" data-rule-required="true" rows="4" cols="80">{{ $descriptionEn }}</textarea>
                                            @include('elements.error_line', ['attribute' => 'trans.en.description'])
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Content <span class="span-red">*</span></label>
                                        <div class="col-sm-9 input-group">
                                            <textarea class="form-control" id="content_ckediter" name="trans[en][content]" maxlength="20000" rows="10" cols="80">{{ $contentEn }}</textarea>
                                            @include('elements.error_line', ['attribute' => 'trans.en.content'])
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Tag <span class="span-red">*</span></label>
                                        <div class="col-sm-9 input-group">
                                            <input type="text" id="tag-en" name="trans[en][tags]" class="form-control" maxlength="200" data-rule-required="true" data-role="tagsinput" value="{{ $tagEn }}">
                                            @include('elements.error_line', ['attribute' => 'trans.en.tags'])
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_vn">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Title <span class="span-red">*</span></label>
                                        <div class="col-sm-9 input-group">
                                            <input type="text" id="title-vn" name="trans[vi][title]" maxlength="200" class="form-control" data-rule-required="true" placeholder="Title ..." value="{{ $titleVn }}">
                                            @include('elements.error_line', ['attribute' => 'trans.vi.title'])
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Slug <span class="span-red">*</span></label>
                                        <div class="col-sm-9 input-group">
                                            <input type="text" id="slug-vn" name="trans[vi][slug]" maxlength="200" class="form-control" data-rule-required="true" value="{{ $slugVn }}">
                                            @include('elements.error_line', ['attribute' => 'trans.vi.slug'])
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Description <span class="span-red">*</span></label>
                                        <div class="col-sm-9 input-group">
                                            <textarea class="form-control" id="des_ckediter_vn" name="trans[vi][description]" maxlength="1000" data-rule-required="true" rows="4" cols="80">{{ $descriptionVn }}</textarea>
                                            @include('elements.error_line', ['attribute' => 'trans.vi.description'])
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Content <span class="span-red">*</span></label>
                                        <div class="col-sm-9 input-group">
                                            <textarea class="form-control" id="content_ckediter_vn" name="trans[vi][content]" maxlength="20000" rows="10" cols="80">{{ $contentVn }}</textarea>
                                            @include('elements.error_line', ['attribute' => 'trans.vi.content'])
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Tag <span class="span-red">*</span></label>
                                        <div class="col-sm-9 input-group">
                                            <input type="text" id="tag-vn" name="trans[vi][tags]" class="form-control" maxlength="200" data-rule-required="true" data-role="tagsinput" value="{{ $tagVn }}">
                                            @include('elements.error_line', ['attribute' => 'trans.vi.tags'])
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <!-- nav-tabs-custom -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"> Main image <span class="span-red">*</span></label>
                                    <div class="col-sm-9 input-group">
                                        <img class="img-thumbnail" src='{{ asset("$blog->image") }}' width="200px" height=""><br><br>
                                        <input type="file" class="form-control" name="image">
                                        @include('elements.error_line', ['attribute' => 'image'])
                                    </div>
                                </div>

                                <div class="button-list col-lg-12">
                                    <div class="col-lg-8 col-lg-offset-2">
                                        <div class="col-lg-3">
                                            <button class="btn btn-block btn-default" form="update-blog" type="submit">Edit</button>
                                        </div>
                                        <div class="col-lg-offset-1 col-lg-3">
                                            <button class="btn btn-block btn-default" form="update-blog" type="reset">Reset</button>
                                        </div>
                                        <div class="col-lg-offset-1 col-lg-3">
                                            <a href="{{ route('blog.index') }}" class="btn btn-block btn-default">Back</a>
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
    <script src="{{ asset('admin/js/bootstrap-tagsinput.js') }}"></script>
    <script>
        $(function () {
            var datepicker = $('.datepicker');
            var titleEn = $("#title-en");
            var slugEn = $("#slug-en");
            var titleVn = $("#title-vn");
            var slugVn = $("#slug-vn");

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

            datepicker.datepicker({ autoclose: true });
            CKFinder.setupCKEditor(contentEditor);
            CKFinder.setupCKEditor(contentEditorVn);

            FormUtil.validate('#update-blog');
            slugCommon.convertSlug(titleEn, slugEn);
            slugCommon.convertSlug(titleVn, slugVn);

            $('#update-blog').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });
        });
    </script>
@endsection
