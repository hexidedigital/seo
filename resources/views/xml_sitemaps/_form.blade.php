<div class="form-group">
    <label>
        {{trans('seo::labels.fields.slug')}}
        <input name="slug" type="text" value="{{old('slug') ?? $model->slug}}" />
    </label>
    {{$errors->first('slug')}}
</div>

<div class="form-group">
    <label>
        {{trans('seo::labels.fields.name')}}
        <input name="name" type="text" value="{{old('name') ?? $model->name}}" />
    </label>
    {{$errors->first('name')}}
</div>

<div class="form-group">
    <label>
        {{trans('seo::labels.fields.priority')}}
        <input name="priority" step="0.1" min="0.0" max="1.0" type="number" value="{{old('priority') ?? $model->priority}}" />
    </label>
    {{$errors->first('priority')}}
</div>

<div class="form-group">
    <label>
        {{trans('seo::labels.fields.changefreq')}}
        <select name="changefreq">
            @foreach($changeFreqs as $frequency)
                <option
                    value="{{$frequency}}"
                    @if(
                            old('changefreq', $model->changefreq) == $frequency
                        )
                        selected
                    @endif
                >
                    {{$frequency}}
                </option>
            @endforeach
        </select>

        {{$errors->first('changefreq')}}
    </label>
</div>

<div class="form-group">
    <label>
        {{trans('seo::labels.fields.frequency')}}
        <select name="frequency">
            @foreach($frequencies as $frequency => $title)
                <option
                    value="{{$frequency}}"
                    @if(
                            old('frequency', $model->frequency) == $frequency
                        )
                        selected
                    @endif
                >
                    {{$title}}
                </option>
            @endforeach
        </select>

        {{$errors->first('frequency')}}
    </label>
</div>

<div class="form-group">
    <label>
        {{trans('seo::labels.fields.path')}}
        <input name="path" type="text" value="{{old('path') ?? $model->path}}" />
    </label>
    {{$errors->first('path')}}
</div>

<div class="form-group">
    <label>
        {{trans('seo::labels.fields.generator')}}
        <input name="generator" type="text" value="{{old('generator') ?? $model->generator}}" />
    </label>
    {{$errors->first('generator')}}
</div>
