<div class="tab-pane active" id="tab_en">
    <div class="form-group">
        <label class="col-sm-3 control-label"> Title <span class="span-red">*</span></label>
        <div class="col-sm-9 input-group">
            <input type="text" id="title-en" name="trans[en][title]" data-rule-required="true" maxlength="200" class="form-control" placeholder="Title ..." value="{{ old('trans.en.title') }}">
            @include('elements.error_line', ['attribute' => 'trans.en.title'])
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label"> Slug <span class="span-red">*</span></label>
        <div class="col-sm-9 input-group">
            <input type="text" id="slug-en" name="trans[en][slug]" data-rule-required="true" maxlength="200" class="form-control" value="{{ old('trans.en.slug') }}">
            @include('elements.error_line', ['attribute' => 'trans.en.slug'])
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label"> Description <span class="span-red">*</span></label>
        <div class="col-sm-9 input-group">
            <textarea class="form-control" id="des_ckediter" name="trans[en][description]" maxlength="1000" data-rule-required="true" rows="4" cols="80">{{ old('trans.en.description') }}</textarea>
            @include('elements.error_line', ['attribute' => 'trans.en.description'])
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label"> Content <span class="span-red">*</span></label>
        <div class="col-sm-9 input-group">
            <textarea class="form-control" id="content_ckediter" name="trans[en][content]" maxlength="20000" rows="10" cols="80">{{ old('trans.en.content') }}</textarea>
            @include('elements.error_line', ['attribute' => 'trans.en.content'])
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label"> Tag <span class="span-red">*</span></label>
        <div class="col-sm-9 input-group">
            <input type="text" id="tag-en" name="trans[en][tags]" class="form-control" maxlength="200" data-rule-required="true" data-role="tagsinput" value="{{ old('trans.en.tags') }}">
            @include('elements.error_line', ['attribute' => 'trans.en.tags'])
        </div>
    </div>
</div>