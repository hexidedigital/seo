@extends('seo::master')

@section('content')
    @php
        $scripts = $scripts ?? []
    @endphp
    <a href="{{\SeoHelper::getRoute('scripts.create')}}" class="seo-btn seo-btn-primary">{{trans('seo::labels.buttons.add')}}</a>
    <table class="seo-table">
        <tr>
            <th>{{trans('seo::labels.fields.title')}}</th>
            <th>{{trans('seo::labels.actions')}}</th>
        </tr>
        @foreach($scripts as $script)
            <tr>
                <td>
                    {{$script->title}}
                </td>
                <td>
                    <a class="seo-btn seo-btn-primary" href="{{\SeoHelper::getRoute('scripts.edit', ['script' => $script])}}">{{trans('seo::labels.buttons.edit')}}</a>
                    <form action="{{ \SeoHelper::getRoute('scripts.destroy', $script->id) }}" method="POST" onsubmit="return confirm('{{trans('seo::labels.delete_confirmation')}}');" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="seo-btn seo-btn-danger" value="{{trans('seo::labels.buttons.delete')}}">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
