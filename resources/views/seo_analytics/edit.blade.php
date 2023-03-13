@extends('seo::master')

@section('content')
    <form action="{{\SeoHelper::getRoute('analytics.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('seo::seo_analytics._form')
        <div>
            <button type="submit"> {{trans('seo::labels.buttons.submit')}} </button>
        </div>
    </form>

@endsection
