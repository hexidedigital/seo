@extends('seo::master')

@section('content')
    @php
        $microformats = $microformats ?? []
    @endphp
    <a href="{{\SeoHelper::getRoute('microformats.create')}}" class="seo-btn seo-btn-primary">{{trans('seo::labels.buttons.add')}}</a>
    <table class="seo-table">
        <tr>
            <th>{{trans('seo::labels.fields.microformat_title')}}</th>
            <th>{{trans('seo::labels.actions')}}</th>
        </tr>
        @foreach($microformats as $microformat)
            <tr>
                <td>
                    {{$microformat->title}}
                </td>
                <td>
                    <a class="seo-btn seo-btn-primary" href="{{\SeoHelper::getRoute('microformats.edit', ['microformat' => $microformat])}}">{{trans('seo::labels.buttons.edit')}}</a>
                    <form action="{{ \SeoHelper::getRoute('microformats.destroy', $microformat->id) }}" method="POST" onsubmit="return confirm('{{trans('seo::labels.delete_confirmation')}}');" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="seo-btn seo-btn-danger" value="{{trans('seo::labels.buttons.delete')}}">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
