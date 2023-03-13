@extends('seo::master')

@section('content')
    @php
        $redirect_rules = $redirect_rules ?? []
    @endphp
    <a href="{{\SeoHelper::getRoute('redirect_rules.create')}}" class="seo-btn seo-btn-primary">{{trans('seo::labels.buttons.add')}}</a>
    <table class="seo-table">
        <tr>
            <th>{{trans('seo::labels.fields.rule')}}</th>
            <th>{{trans('seo::labels.fields.redirect_url')}}</th>
            <th>{{trans('seo::labels.actions')}}</th>
        </tr>
        @foreach($redirect_rules as $redirect_rule)
            <tr>
                <td>
                    {{$redirect_rule->rule}}
                </td>
                <td>
                    {{$redirect_rule->redirect_url}}
                </td>
                <td>
                    <a class="seo-btn seo-btn-primary" href="{{\SeoHelper::getRoute('redirect_rules.edit', ['redirect_rule' => $redirect_rule])}}">{{trans('seo::labels.buttons.edit')}}</a>
                    <form action="{{ \SeoHelper::getRoute('redirect_rules.destroy', $redirect_rule->id) }}" method="POST" onsubmit="return confirm('{{trans('seo::labels.delete_confirmation')}}');" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="seo-btn seo-btn-danger" value="{{trans('seo::labels.buttons.delete')}}">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
