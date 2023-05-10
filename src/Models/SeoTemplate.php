<?php

declare(strict_types=1);

namespace Hexide\Seo\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SeoTemplate extends Model
{
    use Translatable;

    protected $translatedAttributes = [
        'title',
        'description',
        'keywords',
        'og_title',
        'og_description',
        'og_image',
        'image_alt',
        'image_title',
    ];
    protected $fillable = [
        'group',
    ];

    public function models()
    {
        return $this->hasMany(SeoTemplateModels::class);
    }

    /**
     * @param             $query
     * @param string|null $modelTable
     * @param string|null $translationsTable
     * @param string|null $modelTableKey
     * @param string|null $translationsTableKey
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
        if (! $modelTable) {
            $modelTable = $this->getTable();
        }

        $singularModelTable = Str::singular($modelTable);

        if (! $translationsTable) {
            $translationsTable = $singularModelTable . "_translations";
        }

        $translationsTableKey = (empty($translationsTableKey) ? $singularModelTable . "_id" : $translationsTableKey);
        $modelTableKey = (empty($modelTableKey) ? "id" : $modelTableKey);

        return $query->leftJoin(
            $translationsTable,
            function ($join) use ($modelTable, $translationsTable, $translationsTableKey, $modelTableKey): void {
                $join->on("$translationsTable.$translationsTableKey", '=', "$modelTable.$modelTableKey")
                    ->where('locale', '=', app()->getLocale());
            }
        );
    }
}
