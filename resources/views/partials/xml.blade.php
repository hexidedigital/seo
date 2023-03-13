<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($data as $item)
        @php
            $changefreq = $item['changefreq'] ?? $globalChangeFreq;
            $priority = $item['priority'] ?? $globalPriority;
        @endphp
        <url>

            <loc>{{$item['url']}}</loc>

            @if(isset($item['lastmod']) && $item['lastmod'])<lastmod>{{$item['lastmod']}}</lastmod>@endif

            @if(isset($changefreq) && $changefreq)<changefreq>{{$changefreq}}</changefreq>@endif

            @if(isset($priority) && $priority)<priority>{{$priority}}</priority>@endif

        </url>
    @endforeach
</urlset>
