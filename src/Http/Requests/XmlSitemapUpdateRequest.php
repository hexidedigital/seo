<?php

namespace Hexide\Seo\Http\Requests;

use Hexide\Seo\Models\XmlSitemap;
use Illuminate\Foundation\Http\FormRequest;

class XmlSitemapUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $id = $this->route()->parameter('xml_sitemap')?->id;
        $freqs = implode(',', XmlSitemap::$changeFreqs);
        return [
            'slug' => ['required', 'string', 'max:191', 'unique:xml_sitemaps,slug,' . $id . ',id'],
            'name' => ['required', 'string', 'max:191'],
            'frequency' => ['required', 'string', 'max:191'],
            'priority' => ['nullable', 'numeric', 'min:0.01'],
            'changefreq' => ['nullable', 'in:'.$freqs],
            'generator' => ['required', 'string', 'max:191'],
            'path' => ['required', 'string', 'max:191'],
        ];
    }
}
