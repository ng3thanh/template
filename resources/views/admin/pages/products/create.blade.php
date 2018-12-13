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
                        <h3 class="box-title font-15">Basic information</h3>
                    </div>

                    <div class="box-body with-border">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="menu_id"> Menu
                                    <span class="span-red">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <select id="menu_id" class="form-control select2 wp-100" name="menu_id">
                                        @foreach($menu as $key1 => $level1)
                                            <optgroup label="{{ $level1['name'] }}">
                                                <option value="{{ $key1 }}" @if(old('menu_id') == $key1) selected @endif>{{ $level1['name'] }}</option>
                                                @if(isset($level1['child']))
                                                    @foreach($level1['child'] as $key2 => $level2 )
                                                        <option value="{{ $key2 }}" @if(old('menu_id') == $key2) selected @endif> -- {{ $level2['name'] }}</option>
                                                        @if(isset($level2['child']))
                                                            @foreach($level2['child'] as $key3 => $level3 )
                                                                <option value="{{ $key3 }}" @if(old('menu_id') == $key3) selected @endif> ----- {{ $level3['name'] }}</option>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    @include('elements.error_line', ['attribute' => 'trans.en.title'])
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="menu_id"> Origin
                                    <span class="span-red">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <select id="origin" class="form-control wp-100" name="origin">
                                        @foreach($origin as $key => $value)
                                            <option value="{{ $key }}" @if(old('origin') == $key) selected @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @include('elements.error_line', ['attribute' => 'trans.en.title'])
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="code"> Code
                                    <span class="span-red">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" id="code" name="code" data-rule-required="true"
                                           maxlength="200" class="form-control" placeholder="Example: PR001"
                                           value="{{ old('code') }}">
                                    @include('elements.error_line', ['attribute' => 'code'])
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="price"> Price</label>
                                <div class="col-sm-9">
                                    <input type="text" id="price" name="price" maxlength="200" class="form-control" value="{{ old('price') }}">
                                    @include('elements.error_line', ['attribute' => 'price'])
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="menu_id"> Mass</label>
                                <div class="col-sm-9">
                                    <div class="col-sm-6">
                                        <input type="text" id="mass" name="mass" maxlength="200" class="form-control" value="{{ old('mass') }}">
                                    </div>
                                    <div class="col-sm-6">
                                        <select id="mass" class="form-control wp-100" name="mass">
                                            @foreach($mass as $key => $value)
                                                <option value="{{ $key }}" @if(old('mass') == $key) selected @endif>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @include('elements.error_line', ['attribute' => 'code'])
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="quantity"> Quantity</label>
                                <div class="col-sm-9">
                                    <div class="col-sm-6">
                                        <input type="text" id="quantity" name="quantity" maxlength="200" class="form-control" value="{{ old('quantity') }}">
                                    </div>
                                    <div class="col-sm-6">
                                        <select id="quantity" class="form-control wp-100" name="quantity">
                                            @foreach($quantity as $key => $value)
                                                <option value="{{ $key }}" @if(old('quantity') == $key) selected @endif>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @include('elements.error_line', ['attribute' => 'quantity'])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title font-15">Product image</h3>
                    </div>

                    <div class="box-body with-border">
                        <div class="col-md-12">
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="homeimg" id="homeimg" value="">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" id="selectimg">
                                                <em class="fa fa-folder-open-o fa-fix">&nbsp;</em>
                                            </button>
							            </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text"
                                           maxlength="255" name="homeimgalt"
                                           placeholder="Annotations for illustrations (Product details section)">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input type="button" class="btn btn-info" onclick="nv_add_otherimage();" value="More image">
                        </div>
                    </div>
                </div>

                @foreach($languages as $key => $lang)
                    <input class="check_lang" data-key={{ $key }} data-value="{{ $lang }}" type="hidden">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title font-15">Detail information - {{ $lang }}</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>

                        <div class="box-body with-border">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text"
                                           id="title-{{ $key }}"
                                           name="trans[{{ $key }}][title]"
                                           data-rule-required="true"
                                           maxlength="200"
                                           class="form-control"
                                           value="{{ old('trans.en.title') }}"
                                           placeholder="Title">
                                    @include('elements.error_line', ['attribute' => 'trans.en.title'])
                                </div>
                                <div class="form-group">
                                    <input type="text"
                                           id="slug-{{ $key }}"
                                           name="trans[{{ $key }}][slug]"
                                           data-rule-required="true"
                                           maxlength="200"
                                           class="form-control"
                                           value="{{ old('trans.en.slug') }}"
                                           placeholder="Slug">
                                    @include('elements.error_line', ['attribute' => 'trans.en.slug'])
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control"
                                            id="des_ckediter"
                                            name="trans[{{ $key }}][description]"
                                            maxlength="1000"
                                            data-rule-required="true"
                                            rows="4"
                                            cols="80">{{ old('trans.en.description') or 'Description' }}</textarea>
                                    @include('elements.error_line', ['attribute' => 'trans.en.description'])
                                </div>
                                <hr>
                                <div class="form-group">
                                    <textarea
                                            class="form-control"
                                            id="content_ckediter_{{ $key }}"
                                            name="trans[{{ $key }}][content]"
                                            maxlength="20000" rows="10"
                                            cols="80">
                                        {{ old('trans.en.content') }}
                                    </textarea>
                                    @include('elements.error_line', ['attribute' => 'trans.en.content'])
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-md-4">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title font-15">Publish date</h3>
                    </div>
                    <div class="box-body with-border">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepicker">
                        </div>
                    </div>
                </div>
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title font-15">End date</h3>
                    </div>
                    <div class="box-body with-border">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepicker">
                        </div>
                    </div>
                </div>
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title font-15">Tags</h3>
                    </div>
                    <div class="box-body with-border">
                        @foreach($languages as $keyLang => $language)
                            <input type="text" id="tag-{{ $keyLang }}" name="trans[{{ $keyLang }}][tags]"
                               class="form-control" maxlength="200"
                               placeholder="Tags of {{ $language }}"
                               data-role="tagsinput">
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="button-list col-lg-12">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="col-lg-3">
                        <button class="btn btn-block btn-default" form="create-new-product" type="submit">Create
                        </button>
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

            $('.check_lang').each(function( index ) {
                var title = $("#title-" + $(this).data('key'));
                var slug = $("#slug-" + $(this).data('key'));
                slugCommon.convertSlug(title, slug);

                var attr = 'content_ckediter_' + $(this).data('key');
                var contentEditor = CKEDITOR.replace(attr, {
                    filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                    filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
                    filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                    filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                    filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                    filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
                });
                CKFinder.setupCKEditor(contentEditor);
            });

            FormUtil.validate('#create-new-product');

            $('#create-new-product').on('keyup keypress', function (e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });
        });
    </script>
@endsection
