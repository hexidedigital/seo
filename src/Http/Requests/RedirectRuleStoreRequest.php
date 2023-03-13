<?php

namespace Hexide\Seo\Http\Requests;

use Hexide\Seo\Models\SeoScript;
use Illuminate\Foundation\Http\FormRequest;

class RedirectRuleStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'rule' => ['required', 'string', 'max:5000'],
            'redirect_url' => ['required', 'string', 'max:191'],
        ];
    }
}
