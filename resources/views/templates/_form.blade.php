<div class="form-group">
    <label>
        {{trans('seo::labels.fields.group')}}
        <textarea name="group">{{old('group') ?? $model->group}}</textarea>
    </label>
    {{$errors->first('group')}}
</div>
<div class="form-group">
    <label>
        {{trans('seo::labels.fields.models')}}
        <select multiple name="models[]">
            @foreach($models as $project_model)
                <option
                    value="{{$project_model}}"
                    @if(
                            in_array($project_model, old('models', [])) ||
                            (
                                old('models') == null &&
                                $model->models->contains('model_name', $project_model)
                            )
                        )
                        selected
                    @endif
                >
                    {{$project_model}}
                </option>
            @endforeach
        </select>

        {{$errors->first('models')}}
        {{$errors->first('models.*')}}
    </label>
</div>
@foreach(config('translatable.locales') as $locale)
    <strong style="font-size: 30px;">{{$locale}}</strong>
    <div class="form-group">
        <label>
            {{trans('seo::labels.fields.title')}}
            <textarea name="{{$locale.'[title]'}}">{{old($locale .'.group', $model->translate($locale) ? $model->translate($locale)->title : null)}}</textarea>
            {{$errors->first('title')}}
        </label>
    </div>
    <div class="form-group">
        <label>
            {{trans('seo::labels.fields.description')}}
            <textarea name="{{$locale.'[description]'}}">{{old($locale .'.group', $model->translate($locale) ? $model->translate($locale)->description : null)}}</textarea>
            {{$errors->first('description')}}
        </label>
    </div>
    <div class="form-group">
        <label>
            {{trans('seo::labels.fields.keywords')}}
            <textarea name="{{$locale.'[keywords]'}}">{{old($locale .'.group', $model->translate($locale) ? $model->translate($locale)->keywords : null)}}</textarea>
            {{$errors->first('keywords')}}
        </label>
    </div>
    <div class="form-group">
        <label>
            {{trans('seo::labels.fields.og_title')}}
            <textarea name="{{$locale.'[og_title]'}}">{{old($locale .'.group', $model->translate($locale) ? $model->translate($locale)->og_title : null)}}</textarea>
            {{$errors->first('og_title')}}
        </label>
    </div>
    <div class="form-group">
        <label>
            {{trans('seo::labels.fields.og_description')}}
            <textarea name="{{$locale.'[og_description]'}}">{{old($locale .'.group', $model->translate($locale) ? $model->translate($locale)->og_description : null)}}</textarea>
            {{$errors->first('og_description')}}
        </label>
    </div>
    <div class="image-wrap">
        <div class="form-group">
            <label>
                {{trans('seo::labels.fields.og_image')}}
                <input class="input-file" type="file" name="{{$locale.'[og_image]'}}" accept="image"/>
                {{$errors->first('og_image')}}
            </label>
        </div>
        @if($model->id && $model->translate($locale)->og_image)
        <div>
            <img class="preview" data-default="https://via.placeholder.com/150" src="{{SeoHelper::getFileUrl($model->translate($locale)->og_image) ?? "https://via.placeholder.com/150"}}" width="150" height="150"/>
            <button type="button" class="removeImage" class="seo-btn seo-btn-danger" @if(!$model->translate($locale)->og_image) hidden @endif>Delete image</button>
        </div>
        <input type="hidden" name="{{$locale.'[isRemoveImage]'}}" class="isRemoveImage" value="0"/>
        @endif
    </div>
    <div class="form-group">
        <label>
            {{trans('seo::labels.fields.image_alt')}}
            <textarea name="{{$locale.'[image_alt]'}}">{{old($locale .'.group', $model->translate($locale) ? $model->translate($locale)->image_alt : null)}}</textarea>
            {{$errors->first('image_alt')}}
        </label>
    </div>
    <div class="form-group">
        <label>
            {{trans('seo::labels.fields.image_title')}}
            <textarea name="{{$locale.'[image_title]'}}">{{old($locale .'.group', $model->translate($locale) ? $model->translate($locale)->image_title : null)}}</textarea>
            {{$errors->first('image_title')}}
        </label>
    </div>
@endforeach
