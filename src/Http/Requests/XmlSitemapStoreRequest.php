<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Requests;

use Hexide\Seo\Models\XmlSitemap;
use Illuminate\Foundation\Http\FormRequest;

class XmlSitemapStoreRequest extends FormRequest
{
    public function rules(): array
    {
        $freqs = implode(',', XmlSitemap::$changeFreqs);

        return [
            'slug' => ['required', 'string', 'max:191', 'unique:xml_sitemaps,slug'],
            'name' => ['required', 'string', 'max:191'],
            'frequency' => ['required', 'string', 'max:191'],
            'changefreq' => ['nullable', 'in:' . $freqs],
            'priority' => ['required', 'numeric', 'min:0.01'],
            'generator' => ['required', 'string', 'max:191'],
            'path' => ['required', 'string', 'max:191'],
        ];
    }
}
