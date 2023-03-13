@extends('seo::master')

@section('content')
    @php
        $templates = $templates ?? []
    @endphp
    <a href="{{\SeoHelper::getRoute('templates.create')}}" class="seo-btn seo-btn-primary">Add</a>
    <table class="seo-table">
        <tr>
            <th>{{trans('seo::labels.fields.group')}}</th>
            <th>{{trans('seo::labels.actions')}}</th>
        </tr>
        @foreach($templates as $template)
            <tr>
                <td>
                    {{$template->group}}
                </td>
                <td>
                    <a class="seo-btn seo-btn-primary" href="{{\SeoHelper::getRoute('templates.edit', ['template' => $template])}}">{{trans('seo::labels.buttons.edit')}}</a>
                    <form action="{{ \SeoHelper::getRoute('templates.destroy', $template->id) }}" method="POST" onsubmit="return confirm('{{trans('seo::labels.delete_confirmation')}}');" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="seo-btn seo-btn-danger" value="{{trans('seo::labels.buttons.delete')}}">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
