<?php

namespace Hexide\Seo;

use Exception;
use Hexide\Seo\Models\GeneralMeta;
use Hexide\Seo\Models\SeoTemplateModels;
use Hexide\Seo\Services\SeoTemplateService;

class Seo
{
    private mixed $model;
    private SeoTemplateService $templateService;
    private ?GeneralMeta $generalMeta = null;

    public function __construct($model = null)
    {
        $this->model = $model;
        $this->templateService = new SeoTemplateService();
    }

    public function getGeneralMeta(?string $field = null): array|string|null
    {
        if (! $this->generalMeta) {
            $this->generalMeta = GeneralMeta::withTranslation()->firstOrCreate([]);
        }

        if ($field) {
            return $this->generalMeta?->{str_replace('meta_', '', $field)};
        }

        return [
            'title'          => $this->generalMeta?->title,
            'description'    => $this->generalMeta?->description,
            'keywords'       => $this->generalMeta?->keywords,
            'og_title'       => $this->generalMeta?->og_title,
            'og_description' => $this->generalMeta?->og_description,
            'og_image'       => $this->generalMeta?->og_image,
        ];
    }

    public function getAllMeta(array $data = []): array
    {
        $result = [
            'title' => $this->getMetaValue('meta_title'),
            'description' => $this->getMetaValue('meta_description'),
            'keywords' => $this->getMetaValue('keywords'),
            'og_title' => $this->getMetaValue('og_title'),
            'og_description' => $this->getMetaValue('og_description'),
            'og_image' => $this->getMetaValue('og_image'),
            'og_site_name' => $this->getOgSiteName(),
        ];

        if (isset($data['url'])) {
            $result['canonical_url'] = $this->getCanonicalUrl($data['url']);
            $result['og_url'] = $this->getOgUrl($data['url']);
        }

        return $result;
    }

    public function getMetaView(array $data = []): string
    {
        return \SeoHelper::cleanSpaces(view('seo::partials._metadata', ['meta' => $this->getAllMeta($data)])->render());
    }

    private function getMetaValue(string $field, bool $asHtml = false): ?string
    {
        $value = null;

        if ($this->model) {
            $value = $this->getMetaFromModel($field);
        }

        $field = str_replace('meta_', '', $field);

        if (!$value) {
            $value = $this->getGeneralMeta($field);
        }

        if (!$value && $this->model && config('hexide-seo.additional_fields_enabled')) {
            foreach (config('hexide-seo.additional_fields.' . $field, []) as $fieldName) {
                if ($this->model->{$fieldName}) {
                    $value = $this->model->{$fieldName};
                    break;
                }
            }
        }

        if ($field == 'og_image') {
            $value = \Hexide\Seo\Facades\SeoHelper::getFileUrl($value);
        }

        if ($asHtml && $value) {
            return \Hexide\Seo\Facades\SeoHelper::cleanSpaces(view('seo::partials._metadata', ['meta' => [$field => $value]])->render());
        }

        return $value;
    }

    private function getMetaFromModel(string $field): ?string
    {
        $value = $this->model?->{$field};

        if ($value) {
            return $value;
        }

        $field = str_replace('meta_', '', $field);

        $template = SeoTemplateModels::where('model_name', get_class($this->model))
            ->with('template')
            ->first()
            ?->template
            ?->{$field};

        if ($template) {
            $value = $this->templateService->getText($template, $this->model);
        }

        return $value;
    }

    public function for($model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getOgSiteName(): string
    {
        return config('app.name');
    }

    public function getOgSiteNameAsHtml(): string
    {

        $view = view(
            'seo::partials._metadata',
            [
                'meta' => [
                    'og_site_name' => $this->getOgSiteName(),
                ]
            ]
        )->render();
        return \Hexide\Seo\Facades\SeoHelper::cleanSpaces($view);
    }

    public function getOgUrl(string $url): string
    {
        // TODO: remove me or change this method so it is different from canonical url
        return $this->getCanonicalUrl($url);
    }

    public function getOgUrlAsHtml(string $url): string
    {
        $view = view(
            'seo::partials._metadata',
            [
                'meta' => [
                    'og_url' => $this->getOgUrl($url),
                ]
            ]
        )->render();

        return \Hexide\Seo\Facades\SeoHelper::cleanSpaces($view);
    }

    public function getCanonicalUrl(string $url): string
    {
        // remove query params
        $url = explode('?', $url)[0] ?? '';

        // remove anchors
        $url = explode('#', $url)[0] ?? '';

        return $url;
    }

    public function getCanonicalUrlAsHtml(string $url): string
    {
        $view = view(
            'seo::partials._metadata',
            [
                'meta' => [
                    'canonical_url' => $this->getCanonicalUrl($url),
                ]
            ]
        )->render();

        return \Hexide\Seo\Facades\SeoHelper::cleanSpaces($view);
    }

    public function getLocalizationMeta(string $url): array
    {
        $data = [];

        $parsedUrl = parse_url($url);

        $path = $parsedUrl['path'] ?? null;

        if (! $path) {
            return $data;
        }

        $segmentedPath = explode('/', $path);

        if ($segmentedPath[0] == '') {
            $segmentedPath = array_slice($segmentedPath, 1);
        }

        $index = 0;
        if (isset($segmentedPath[0]) && in_array($segmentedPath[0], config('translatable.locales'))) {
            unset($segmentedPath[$index]);
        } elseif (isset($segmentedPath[1]) && in_array($segmentedPath[1], config('translatable.locales'))) {
            $index = 1;
            unset($segmentedPath[$index]);
        }

        foreach (config('translatable.locales') as $locale) {
            $newSegments = $segmentedPath;
            array_splice($newSegments, $index, 0, $locale);
            $data[$locale] = $this->mergeUrl($parsedUrl, '/' . implode('/', $newSegments));
        }

        return $data;
    }

    private function mergeUrl(array $parsed_url, string $path): string
    {
        $scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '';

        $host     = $parsed_url['host'] ?? '';

        $port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';

        $user     = $parsed_url['user'] ?? '';

        $pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass'] : '';

        $pass     = ($user || $pass) ? "$pass@" : '';

        $query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';

        $fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';

        return "$scheme$user$pass$host$port$path$query$fragment";

    }



    public function getLocalizationMetaAsHtml(string $url): string
    {
        $view = view(
            'seo::partials._metadata',
            [
                    'meta' => ['x_localization' => $this->getLocalizationMeta($url)],
                ]
        )->render();

        return \Hexide\Seo\Facades\SeoHelper::cleanSpaces($view);
    }

    /**
     * @throws Exception
     */
    public function __call($method, $arguments)
    {
        if (isset($this->{$method}) && is_callable($this->{$method})) {
            return call_user_func_array($this->{$method}, $arguments);
        } elseif (str_starts_with($method, 'get')) {
            $asHtml = str_ends_with($method, 'AsHtml');

            $field = \Str::snake(
                str_replace(
                    'AsHtml',
                    '',
                    str_replace(
                        'get',
                        '',
                        $method
                    )
                )
            );

            return $this->getMetaValue($field, $asHtml);
        }

        throw new Exception("Fatal error: Call to undefined method Seo::{$method}()");
    }
}
