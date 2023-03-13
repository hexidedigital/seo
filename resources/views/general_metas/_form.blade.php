@foreach(config('translatable.locales') as $locale)
    <strong style="font-size: 30px;">{{$locale}}</strong>
    <div class="form-group">
        <label>
            {{trans('seo::labels.fields.title')}}
            <textarea name="{{$locale .'[title]'}}">{{old($locale .'.title', $model->translate($locale) ? $model->translate($locale)->title : null)}}</textarea>
            {{$errors->first($locale.'.title')}}
        </label>
    </div>
    <div class="form-group">
        <label>
            {{trans('seo::labels.fields.description')}}
            <textarea name="{{$locale .'[description]'}}">{{old($locale .'.description', $model->translate($locale) ? $model->translate($locale)->description : null)}}</textarea>
            {{$errors->first($locale.'.description')}}
        </label>
    </div>
    <div class="form-group">
        <label>
            {{trans('seo::labels.fields.keywords')}}
            <textarea name="{{$locale .'[keywords]'}}">{{old($locale .'.keywords', $model->translate($locale) ? $model->translate($locale)->keywords : null)}}</textarea>
            {{$errors->first($locale.'.keywords')}}
        </label>
    </div>
    <div class="form-group">
        <label>
            {{trans('seo::labels.fields.og_title')}}
            <textarea name="{{$locale .'[og_title]'}}">{{old($locale .'.og_title', $model->translate($locale) ? $model->translate($locale)->og_title : null)}}</textarea>
            {{$errors->first($locale.'.og_title')}}
        </label>
    </div>
    <div class="form-group">
        <label>
            {{trans('seo::labels.fields.og_description')}}
            <textarea name="{{$locale .'[og_description]'}}">{{old($locale .'.og_description', $model->translate($locale) ? $model->translate($locale)->og_description : null)}}</textarea>
            {{$errors->first($locale.'.og_description')}}
        </label>
    </div>
    <div class="image-wrap">
        <div class="form-group">
            <label>
                {{trans('seo::labels.fields.og_image')}}
                <input class="input-file" type="file" name="{{$locale.'[og_image]'}}" accept="image"/>
                {{$errors->first($locale.'.og_image')}}
            </label>
        </div>
        @if($model->id && $model->translate($locale)?->og_image)
            <div>
                <img class="preview" data-default="https://via.placeholder.com/150" src="{{SeoHelper::getFileUrl($model->translate($locale)?->og_image) ?? "https://via.placeholder.com/150"}}" width="150" height="150"/>
                <button type="button" class="removeImage" class="seo-btn seo-btn-danger" @if(!$model->translate($locale)?->og_image) hidden @endif>Delete image</button>
            </div>
            <input type="hidden" name="{{$locale.'[isRemoveImage]'}}" class="isRemoveImage" value="0"/>
        @endif
    </div>
    <hr>
@endforeach
