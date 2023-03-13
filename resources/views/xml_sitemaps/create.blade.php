@extends('seo::master')

@section('content')
    <a href="{{\SeoHelper::getRoute('xml_sitemaps.index')}}"><button type="button"> {{trans('seo::labels.buttons.back')}} </button></a>
    <form action="{{\SeoHelper::getRoute('xml_sitemaps.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('seo::xml_sitemaps._form')
        <div>
            <button type="submit"> {{trans('seo::labels.buttons.submit')}} </button>
        </div>
    </form>

@endsection
