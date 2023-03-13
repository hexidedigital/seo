@extends('seo::master')

@section('content')
    <form action="{{\SeoHelper::getRoute('general-meta.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('seo::general_metas._form')
        <div>
            <button type="submit"> {{trans('seo::labels.buttons.submit')}} </button>
        </div>
    </form>

@endsection
