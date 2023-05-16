<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Controllers;

use Hexide\Seo\Facades\SeoHelper;
use Hexide\Seo\Http\Requests\XmlSitemapStoreRequest;
use Hexide\Seo\Http\Requests\XmlSitemapUpdateRequest;
use Hexide\Seo\Models\XmlSitemap;

class XmlSitemapController extends Controller
{
    public function index()
    {
        $data = [
            'xml_sitemaps' => XmlSitemap::all(),
        ];

        return view('seo::xml_sitemaps.index', $data);
    }

    public function create()
    {
        $data = [
            'frequencies' => XmlSitemap::formOptions(),
            'changeFreqs' => XmlSitemap::$changeFreqs,
            'model' => new XmlSitemap(),
        ];

        return view('seo::xml_sitemaps.create', $data);
    }

    public function store(XmlSitemapStoreRequest $request)
    {
        $data = $request->validated();

        XmlSitemap::create($data);

        return redirect(SeoHelper::getRoute('xml_sitemaps.index'));
    }

    public function edit(XmlSitemap $xml_sitemap)
    {
        $data = [
            'frequencies' => XmlSitemap::formOptions(),
            'changeFreqs' => XmlSitemap::$changeFreqs,
            'model' => $xml_sitemap,
        ];

        return view('seo::xml_sitemaps.edit', $data);
    }

    public function update(XmlSitemap $xml_sitemap, XmlSitemapUpdateRequest $request)
    {
        $data = $request->validated();

        $xml_sitemap->update($data);

        return redirect(SeoHelper::getRoute('xml_sitemaps.index'));
    }

    public function destroy(XmlSitemap $xml_sitemap)
    {
        $xml_sitemap->delete();

        return redirect(SeoHelper::getRoute('xml_sitemaps.index'));
    }
}
