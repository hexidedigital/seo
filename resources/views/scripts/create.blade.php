@extends('seo::master')

@section('content')
    <a href="{{\SeoHelper::getRoute('scripts.index')}}"><button type="button"> {{trans('seo::labels.buttons.back')}} </button></a>
    <form action="{{\SeoHelper::getRoute('scripts.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('seo::scripts._form')
        <div>
            <button type="submit"> {{trans('seo::labels.buttons.submit')}} </button>
        </div>
    </form>

@endsection
