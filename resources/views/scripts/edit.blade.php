@extends('seo::master')

@section('content')
    <a href="{{\SeoHelper::getRoute('scripts.index')}}"><button type="button"> {{trans('seo::labels.buttons.back')}} </button></a>
    <form action="{{\SeoHelper::getRoute('scripts.update', ['script' => $model])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('seo::scripts._form')
        <div>
            <button type="submit"> {{trans('seo::labels.buttons.submit')}} </button>
        </div>
    </form>

@endsection
