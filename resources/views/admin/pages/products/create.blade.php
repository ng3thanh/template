@extends('admin.layout')

@section('title', 'Create new product')

@section('css')

@endsection

@section('content')
    <section class="content">
        <form role="form"
              id="create-new-product"
              class="form-horizontal"
              action="{{ route('product.store') }}"
              method="POST"
              enctype="multipart/form-data">

            {{ csrf_field() }}
            <div class="col-md-8">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Basic information</h3>
                    </div>

                    <div class="box-body with-border">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="title-en"> Title <span class="span-red">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" id="title-en" name="trans[en][title]" data-rule-required="true" maxlength="200" class="form-control" placeholder="Title ..." value="{{ old('trans.en.title') }}">
                                    @include('elements.error_line', ['attribute' => 'trans.en.title'])
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="slug-en"> Slug <span class="span-red">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" id="slug-en" name="trans[en][slug]" data-rule-required="true" maxlength="200" class="form-control" value="{{ old('trans.en.slug') }}">
                                    @include('elements.error_line', ['attribute' => 'trans.en.slug'])
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="des_ckediter"> Description <span class="span-red">*</span></label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="des_ckediter" name="trans[en][description]" maxlength="1000" data-rule-required="true" rows="4" cols="80">{{ old('trans.en.description') }}</textarea>
                                    @include('elements.error_line', ['attribute' => 'trans.en.description'])
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="content_ckediter"> Content <span class="span-red">*</span></label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="content_ckediter" name="trans[en][content]" maxlength="20000" rows="10" cols="80">{{ old('trans.en.content') }}</textarea>
                                    @include('elements.error_line', ['attribute' => 'trans.en.content'])
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="tag-en"> Tag <span class="span-red">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" id="tag-en" name="trans[en][tags]" class="form-control" maxlength="200" data-rule-required="true" data-role="tagsinput" value="{{ old('trans.en.tags') }}">
                                    @include('elements.error_line', ['attribute' => 'trans.en.tags'])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Publish date</h3>
                    </div>
                    <div class="box-body with-border">
                    </div>
                </div>
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">End date</h3>
                    </div>
                    <div class="box-body with-border">
                    </div>
                </div>
            </div>

            <div class="button-list col-lg-12">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="col-lg-3">
                        <button class="btn btn-block btn-default" form="create-new-product" type="submit">Create</button>
                    </div>
                    <div class="col-lg-offset-1 col-lg-3">
                        <button class="btn btn-block btn-default" form="create-new-product" type="reset">Reset</button>
                    </div>
                    <div class="col-lg-offset-1 col-lg-3">
                        <a href="{{ route('product.index') }}" class="btn btn-block btn-default">Back</a>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <div class="clearfix"></div>
@endsection

@section('script')
    <script>
        $(function () {
            var titleEn = $("#title-en");
            var slugEn = $("#slug-en");
            var titleVn = $("#title-vn");
            var slugVn = $("#slug-vn");

            var contentEditor = CKEDITOR.replace( 'content_ckediter', {
                filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
                filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
            });

            var contentEditorVn = CKEDITOR.replace( 'content_ckediter_vn', {
                filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
                filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
            });

            CKFinder.setupCKEditor(contentEditor);
            CKFinder.setupCKEditor(contentEditorVn);

            FormUtil.validate('#create-new-product');
            slugCommon.convertSlug(titleEn, slugEn);
            slugCommon.convertSlug(titleVn, slugVn);

            $('#create-new-product').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });
        });
    </script>
@endsection
