<div class="form-group">
    <label>
        {{trans('seo::labels.fields.gtm_id')}}
        <input name="gtm_id" type="text" value="{{old('gtm_id') ?? $model->gtm_id}}" />
    </label>
    {{$errors->first('gtm_id')}}
</div>

<div class="form-group">
    <label>
        {{trans('seo::labels.fields.ga_tracking_id')}}
        <input name="ga_tracking_id" type="text" value="{{old('ga_tracking_id') ?? $model->ga_tracking_id}}" />
    </label>
    {{$errors->first('ga_tracking_id')}}
</div>

<div class="form-group">
    <label>
        {{trans('seo::labels.fields.fb_pixel_id')}}
        <input name="fb_pixel_id" type="text" value="{{old('fb_pixel_id') ?? $model->fb_pixel_id}}" />
    </label>
    {{$errors->first('fb_pixel_id')}}
</div>

<div class="form-group">
    <label>
        {{trans('seo::labels.fields.hjar_id')}}
        <input name="hjar_id" type="text" value="{{old('hjar_id') ?? $model->hjar_id}}" />
    </label>
    {{$errors->first('hjar_id')}}
</div>
