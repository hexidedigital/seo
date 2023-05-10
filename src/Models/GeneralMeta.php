<?php

declare(strict_types=1);

namespace Hexide\Seo\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GeneralMeta extends Model
{
    use Translatable;

    protected $translatedAttributes = [
        'group',
        'title',
        'description',
        'keywords',
        'og_title',
        'og_description',
        'og_image',
    ];

    protected $fillable = [];

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithTranslations(Builder $query)
    {
        return $query->with(
            [
                'translations' => function ($query): void {
                    $query->where('locale', app()->getLocale());
                },
            ]
        );
    }

    /**
     * @param null|string $modelTable
     * @param null|string $translationsTable
     * @param null|string $modelTableKey
     * @param null|string $translationsTableKey
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeJoinTranslations(
        Builder $query,
        $modelTable = null,
        $translationsTable = null,
        $modelTableKey = null,
        $translationsTableKey = null
    ) {
        if (!$modelTable) {
            $modelTable = $this->getTable();
        }

        $singularModelTable = Str::singular($modelTable);

        if (!$translationsTable) {
            $translationsTable = $singularModelTable . "_translations";
        }

        $translationsTableKey = (empty($translationsTableKey) ? $singularModelTable . "_id" : $translationsTableKey);
        $modelTableKey = (empty($modelTableKey) ? "id" : $modelTableKey);

        return $query->leftJoin(
            $translationsTable,
            function ($join) use ($modelTable, $translationsTable, $translationsTableKey, $modelTableKey): void {
                $join->on("{$translationsTable}.{$translationsTableKey}", '=', "{$modelTable}.{$modelTableKey}")
                    ->where('locale', '=', app()->getLocale());
            }
        );
    }
}
