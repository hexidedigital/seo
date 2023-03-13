@extends('seo::master')

@section('content')
    <a href="{{\SeoHelper::getRoute('redirect_rules.index')}}"><button type="button"> {{trans('seo::labels.buttons.back')}} </button></a>
    <form action="{{\SeoHelper::getRoute('redirect_rules.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('seo::redirect_rules._form')
        <div>
            <button type="submit"> {{trans('seo::labels.buttons.submit')}} </button>
        </div>
    </form>

@endsection
