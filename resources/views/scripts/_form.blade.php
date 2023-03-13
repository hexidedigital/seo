<div class="form-group">
    <label>
        {{trans('seo::labels.fields.title')}}
        <input name="title" type="text" value="{{old('title') ?? $model->title}}" />
    </label>
    {{$errors->first('title')}}
</div>

<div class="form-group">
    <label>
        {{trans('seo::labels.fields.script_type')}}
        <select name="type">
            @foreach($types as $type)
                <option value="{{$type}}" @if(old('type', $model->type) == $type) selected @endif>{{$type}}</option>
            @endforeach
        </select>
        {{$errors->first('type')}}
    </label>
</div>

<div class="form-group">
    <label>
        {{trans('seo::labels.fields.text')}}
        <textarea name="text">{{old('text') ?? $model->text}}</textarea>
    </label>
    {{$errors->first('text')}}
</div>
