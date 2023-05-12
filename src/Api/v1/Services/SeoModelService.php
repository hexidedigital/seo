<?php

declare(strict_types=1);

namespace Hexide\Seo\Api\v1\Services;

use Exception;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SeoModelService
{
    public function getModel($model_name, $id)
    {
        $namespace = $this->guessNamespaceByName($model_name);

        if ($namespace) {
            try {
                $field = is_numeric($id) ? 'id' : 'slug';
                $model = $namespace::where($field, $id)->first();
            } catch (Exception $e) {
                Log::error('Getting model item for seo api - ' . $e->getMessage());

                return null;
            }

            return $model;
        }

        return null;
    }

    private function guessNamespaceByName(string $name): ?string
    {
        $namespace = config("hexide-seo.custom_model_names.{$name}");

        if ($namespace && class_exists($namespace)) {
            return $namespace;
        }

        return $this->getNamespaceFromName(Str::singular($name)) ?? $this->getNamespaceFromName(Str::plural($name));
    }

    private function getNamespaceFromName(string $name): ?string
    {
        $modelNamespace = config('hexide-seo.model_namespace') ?? 'Models';

        $namespace = sprintf(
            '%s%s%s',
            Container::getInstance()->getNamespace(),
            $modelNamespace ? $modelNamespace . '\\' : '',
            Str::studly($name)
        );

        return class_exists($namespace) ? $namespace : null;
    }
}
