<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Middleware;

use Closure;
use Exception;
use Hexide\Seo\Models\RedirectRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class RedirectMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $path = $request->path();

        foreach ($this->getRules() as $rule) {
            $pattern = "/{$rule->rule}/";

            try {
                if (preg_match($pattern, $path)) {
                    $newPath = preg_replace($pattern, $rule->redirect_url, $path);

                    return redirect($newPath);
                }
            } catch (Exception $e) {
            }
        }

        return $next($request);
    }

    protected function getRules(): mixed
    {
        return Cache::remember(
            $this->getCacheKey(),
            config('hexide-seo.cache_ttl', 300),
            fn () => RedirectRule::all()
        );
    }

    protected function getCacheKey(): string
    {
        return Str::of($this::class)
            ->slug()
            ->append('-rules')
            ->value();
    }
}
