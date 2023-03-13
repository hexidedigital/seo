@extends('seo::master')

@section('content')
    @php
        $xml_sitemaps = $xml_sitemaps ?? [];
        $module = 'xml_sitemaps';
    @endphp
    <a href="{{\SeoHelper::getRoute($module . '.create')}}" class="seo-btn seo-btn-primary">{{trans('seo::labels.buttons.add')}}</a>
    <table class="seo-table">
        <tr>
            <th>{{trans('seo::labels.fields.slug')}}</th>
            <th>{{trans('seo::labels.fields.name')}}</th>
            <th>{{trans('seo::labels.actions')}}</th>
        </tr>
        @foreach($xml_sitemaps as $model)
            <tr>
                <td>
                    {{$model->slug}}
                </td>
                <td>
                    {{$model->name}}
                </td>
                <td>
                    <a class="seo-btn seo-btn-primary" href="{{\SeoHelper::getRoute($module . '.edit', ['xml_sitemap' => $model])}}">{{trans('seo::labels.buttons.edit')}}</a>
                    <form action="{{ \SeoHelper::getRoute($module . '.destroy', $model->id) }}" method="POST" onsubmit="return confirm('{{trans('seo::labels.delete_confirmation')}}');" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="seo-btn seo-btn-danger" value="{{trans('seo::labels.buttons.delete')}}">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
