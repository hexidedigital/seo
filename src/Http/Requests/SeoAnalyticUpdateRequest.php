<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeoAnalyticUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'gtm_id' => ['nullable', 'string', 'max:191'],
            'ga_tracking_id' => ['nullable', 'string', 'max:191'],
            'fb_pixel_id' => ['nullable', 'string', 'max:191'],
            'hjar_id' => ['nullable', 'string', 'max:191'],
        ];
    }
}
