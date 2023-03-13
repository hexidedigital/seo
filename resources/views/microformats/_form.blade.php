<div class="form-group">
    <label>
        {{trans('seo::labels.fields.microformat_title')}}
        <input name="title" type="text" value="{{old('title') ?? $model->title}}" />
    </label>
    {{$errors->first('title')}}
</div>

<div class="form-group">
    <label>
        {{trans('seo::labels.fields.text')}}
        <textarea name="text">{{old('text') ?? $model->text}}</textarea>
    </label>
    {{$errors->first('text')}}
</div>
