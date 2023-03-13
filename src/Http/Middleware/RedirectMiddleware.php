<?php

namespace Hexide\Seo\Http\Middleware;

use Closure;
use Hexide\Seo\Models\RedirectRule;
use Illuminate\Http\Request;

class RedirectMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $rules = \Cache::remember('rules', config('hexide-seo.cache_ttl'), function () {
            return RedirectRule::all();
        });

        $path = $request->path();

        foreach ($rules as $rule) {
            $pattern = "/$rule->rule/";
            try {
                if (preg_match($pattern, $path)) {
                    $newPath = preg_replace($pattern, $rule->redirect_url, $path);
                    return redirect($newPath);
                }
            } catch (\Exception $e) {
            }
        }

        return $next($request);
    }
}
