<?php

declare(strict_types=1);

namespace Hexide\Seo\Models\Traits;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Str;

/**
 * @mixin Model
 */
trait WithTranslations
{
    public function scopeWithTranslations(EloquentBuilder $query): EloquentBuilder
    {
        return $query->with([
            'translations' => function ($query): void {
                /* @var EloquentBuilder $query */
                $query->where('locale', app()->getLocale());
            },
        ]);
    }

    public function scopeJoinTranslations(
        EloquentBuilder $query,
        string $modelTable = null,
        string $translationsTable = null,
        string $modelTableKey = null,
        string $translationsTableKey = null
    ): EloquentBuilder|Builder {
        if (!$modelTable) {
            $modelTable = $this->getTable();
        }

        $singularModelTable = Str::singular($modelTable);

        if (!$translationsTable) {
            $translationsTable = $singularModelTable . "_translations";
        }

        $translationsTableKey = empty($translationsTableKey) ? $singularModelTable . "_id" : $translationsTableKey;
        $modelTableKey = empty($modelTableKey) ? "id" : $modelTableKey;

        return $query->leftJoin(
            $translationsTable,
            function ($join) use ($modelTable, $translationsTable, $translationsTableKey, $modelTableKey): void {
                /* @var JoinClause $join */
                $join->on("{$translationsTable}.{$translationsTableKey}", '=', "{$modelTable}.{$modelTableKey}")
                    ->where('locale', '=', app()->getLocale());
            }
        );
    }
}
