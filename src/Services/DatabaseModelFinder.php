<?php

declare(strict_types=1);

namespace Hexide\Seo\Services;

use Exception;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DatabaseModelFinder
{
    public function findModel(string $modelName, string|int $identity): ?Model
    {
        /** @var Model|string|null $namespace */
        $namespace = $this->guessNamespaceByName($modelName);

        if (!$namespace) {
            return null;
        }

        try {
            $field = $this->getSearchField($identity);

            return (new $namespace())->newQuery()->where($field, $identity)->first();
        } catch (Exception $e) {
            Log::error('Getting model item for seo api - ' . $e->getMessage());

            return null;
        }
    }

    protected function getSearchField(int|string $identity): string
    {
        return is_numeric($identity) ? 'id' : 'slug';
    }

    protected function guessNamespaceByName(string $name): ?string
    {
        $namespace = config("hexide-seo.custom_model_names.{$name}");

        if ($namespace && class_exists($namespace)) {
            return $namespace;
        }

        return $this->getNamespaceFromName(Str::singular($name)) ?? $this->getNamespaceFromName(Str::plural($name));
    }

    protected function getNamespaceFromName(string $name): ?string
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
