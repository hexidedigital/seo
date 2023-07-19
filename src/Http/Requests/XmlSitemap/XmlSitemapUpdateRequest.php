<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Requests\XmlSitemap;

use Hexide\Seo\Models\XmlSitemap;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class XmlSitemapUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique(XmlSitemap::class, 'slug')->ignore($this->route('xml_sitemap')),
            ],
            'name' => ['required', 'string', 'max:255'],
            'frequency' => ['required', 'string', 'max:255'],
            'priority' => ['nullable', 'numeric', 'min:0.01', 'max:1.0'],
            'changefreq' => ['nullable', Rule::in(XmlSitemap::$changeFreqs)],
            'generator' => ['required', 'string', 'max:255'],
            'path' => ['required', 'string', 'max:255'],
        ];
    }
}
