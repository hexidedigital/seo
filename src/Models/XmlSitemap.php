<?php

declare(strict_types=1);

namespace Hexide\Seo\Models;

use Illuminate\Database\Eloquent\Model;

class XmlSitemap extends Model
{
    public const FREQUENCY_30_MIN = '30minutes';
    public const FREQUENCY_HOUR = 'hour';
    public const FREQUENCY_DAY = 'day';
    public const FREQUENCY_WEEK = 'week';
    public const FREQUENCY_MONTH = 'month';

    public static array $changeFreqs = [
        'always',
        'hourly',
        'daily',
        'weekly',
        'monthly',
        'yearly',
        'never',
    ];

    protected $fillable = [
        'slug',
        'name',
        'frequency',
        'changefreq',
        'priority',
        'generator',
        'path',
        'generated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'generated_at' => 'datetime',
    ];

    public static function formOptions(): array
    {
        return [
            self::FREQUENCY_30_MIN => __('seo::labels.frequencies.' . self::FREQUENCY_30_MIN),
            self::FREQUENCY_HOUR => __('seo::labels.frequencies.' . self::FREQUENCY_HOUR),
            self::FREQUENCY_DAY => __('seo::labels.frequencies.' . self::FREQUENCY_DAY),
            self::FREQUENCY_WEEK => __('seo::labels.frequencies.' . self::FREQUENCY_WEEK),
            self::FREQUENCY_MONTH => __('seo::labels.frequencies.' . self::FREQUENCY_MONTH),
        ];
    }

    public function getGeneratorInstance()
    {
        $generatorPath = str_replace('/', '\\', $this->generator);

        return new $generatorPath();
    }

    public function needsUpdate(): bool
    {
        $now = now();

        // if sitemap was not generated yet
        if (is_null($this->generated_at)) {
            return true;
        }

        // If user changed something recently
        if ($this->updated_at->isAfter($this->generated_at)) {
            return true;
        }

        // Since months could have different minutes, we should check for monthly generations
        if ($this->frequency == self::FREQUENCY_MONTH) {
            return $now->diffInMonths($this->generated_at) >= 1;
        }

        // Get needed time before next generation in minutes
        $difference = $now->diffInMinutes($this->generated_at);

        // Convert frequency to minutes
        $neededDifference = match ($this->frequency) {
            self::FREQUENCY_30_MIN => 30,
            self::FREQUENCY_HOUR => 60,
            self::FREQUENCY_DAY => 1440,
            self::FREQUENCY_WEEK => 10080,
            default => INF, // If our frequency is wrong, we shouldn't generate anything
        };

        return $difference >= $neededDifference;
    }
}
