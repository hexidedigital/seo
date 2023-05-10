<?php

namespace Hexide\Seo;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SeoHelper
{
    public function getFileUrl(?string $path, bool $favicon = false): ?string
    {
        if ($favicon) {
            return config('app.url') . '/' . str_replace('public', '', $path);
        }

        if ($path) {
            if (!str_contains($path, 'http')) {
                return str_contains($path, 'storage/') ? asset($path) : asset('storage/'.$path);
            }

            return $path;
        }

        return null;
    }

    public function storeImage($image): bool|string
    {
        $path = $this->preparePath('uploads'. '/' . 'images' . '/' . 'seo');

        return Storage::disk('public')->putFile($path, new File($image->getPathname()));
    }

    public function deleteImage(?string $path): void
    {
        if ($path) {
            Storage::delete($path);
        }
    }

    public function getModelsList(): array
    {
        $appNamespace = Container::getInstance()->getNamespace();

        $modelNamespace = config('hexide-seo.model_namespace') ?? 'Models';

        $path = str_replace('\\', '/', $modelNamespace);

        $models = collect(\File::allFiles(app_path($path)))
            ->map(function ($item) use ($appNamespace, $modelNamespace) {
                $rel   = $item->getRelativePathName();
                $class = sprintf(
                    '%s%s%s',
                    $appNamespace,
                    $modelNamespace ? $modelNamespace . '\\' : '',
                    implode(
                        '\\',
                        explode(
                            '/',
                            substr(
                                $rel,
                                0,
                                strrpos($rel, '.')
                            )
                        )
                    )
                );
                return class_exists($class) ? $class : null;
            })->filter();

        return $models->filter(
            function ($model) {
                return is_subclass_of($model, Model::class);
            }
        )->toArray();
    }

    public function langRules(array $rules, array $locales = null): array
    {
        return RuleFactory::make($rules, null, null, null, $locales);
    }

    public function getRoute(string $route, $arguments = null): string
    {
        return route(config("hexide-seo.routes.web.as", '') . $route, $arguments);
    }

    public function cleanSpaces(string $text): string
    {
        return preg_replace('/\\s+/', ' ', $text);
    }


    private function preparePath(string $root): string
    {
        $name = Str::lower(Str::random(32));

        $a = substr($name, 0, 2);
        $b = substr($name, 2, 2);

        return $root . '/' . $a . '/' . $b;
    }
}
