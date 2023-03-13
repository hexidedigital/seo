@extends('seo::master')

@section('content')
    <a href="{{\SeoHelper::getRoute('microformats.index')}}"><button type="button"> {{trans('seo::labels.buttons.back')}} </button></a>
    <form action="{{\SeoHelper::getRoute('microformats.update', ['microformat' => $model])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('seo::microformats._form')
        <div>
            <button type="submit"> {{trans('seo::labels.buttons.submit')}} </button>
        </div>
    </form>

@endsection
