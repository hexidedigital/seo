@if(isset($meta['title']) && $meta['title'])
    <title>{{$meta['title']}}</title>
@endif

@if(isset($meta['description']) && $meta['description'])
    <meta name="description" content="{{$meta['description']}}"/>
@endif

@if(isset($meta['keywords']) && $meta['keywords'])
    <meta name="keywords" content="{{$meta['keywords']}}"/>
@endif

@if(isset($meta['og_title']) && $meta['og_title'])
    <meta property="og:title" content="{{$meta['og_title']}}">
@endif

@if(isset($meta['og_description']) && $meta['og_description'])
    <meta property="og:description" content="{{$meta['og_description']}}">
@endif

@if(isset($meta['og_image']) && $meta['og_image'])
    <meta property="og:image" content="{{$meta['og_image']}}">
@endif

@if(isset($meta['og_url']) && $meta['og_url'])
    <meta property="og:url" content="{{$meta['og_url']}}">
@endif

@if(isset($meta['og_site_name']) && $meta['og_site_name'])
    <meta property="og:site_name" content="{{$meta['og_site_name']}}">
@endif

@if(isset($meta['canonical_url']) && $meta['canonical_url'])
    <link rel="canonical" href="{{$meta['canonical_url']}}" />
@endif

@if(isset($meta['x_localization']) && $meta['x_localization'])
    @foreach($meta['x_localization'] as $locale => $url)
        <link rel="alternate" href="{{$url}}" hreflang="{{$locale}}" />
    @endforeach
@endif
