@extends('seo::master')

@section('content')
    <a href="{{\SeoHelper::getRoute('xml_sitemaps.index')}}"><button type="button"> {{trans('seo::labels.buttons.back')}} </button></a>
    <form action="{{\SeoHelper::getRoute('xml_sitemaps.update', ['xml_sitemap' => $model])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('seo::xml_sitemaps._form')
        <div>
            <button type="submit"> {{trans('seo::labels.buttons.submit')}} </button>
        </div>
    </form>

@endsection
