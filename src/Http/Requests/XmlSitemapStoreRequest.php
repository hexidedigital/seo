<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Requests;

use Hexide\Seo\Models\XmlSitemap;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class XmlSitemapStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'slug' => ['required', 'string', 'max:255', Rule::unique(XmlSitemap::class, 'slug')],
            'name' => ['required', 'string', 'max:255'],
            'frequency' => ['required', 'string', 'max:255'],
            'changefreq' => ['nullable', Rule::in(XmlSitemap::$changeFreqs)],
            'priority' => ['nullable', 'numeric', 'min:0.01', 'max:1.0'],
            'generator' => ['required', 'string', 'max:255'],
            'path' => ['required', 'string', 'max:255'],
        ];
    }
}
