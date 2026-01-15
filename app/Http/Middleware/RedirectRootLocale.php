<?php

namespace App\Http\Middleware;
use Closure;

class RedirectRootLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        if ($request->path() === '/') {
            $locale = $request->getPreferredLanguage(['id', 'en']) ?? 'id';
            return redirect('/' . $locale);
        }

        return $next($request);
    }
}
