<div class="form-group">
    <label>
        {{trans('seo::labels.fields.rule')}}
        <textarea name="rule">{{old('rule') ?? $model->rule}}</textarea>
    </label>
    {{$errors->first('rule')}}
</div>

<div class="form-group">
    <label>
        {{trans('seo::labels.fields.redirect_url')}}
        <input name="redirect_url" type="text" value="{{old('redirect_url') ?? $model->redirect_url}}" />
    </label>
    {{$errors->first('redirect_url')}}
</div>
