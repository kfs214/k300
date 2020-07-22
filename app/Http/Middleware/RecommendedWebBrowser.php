<?php

namespace App\Http\Middleware;

use Closure;

class RecommendedWebBrowser
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
        $ua = $request->header('User-Agent');

        $deprecated = '/(messenger|fbav|FBAN|FBIOS)/i';

        if(preg_match($deprecated, $ua)){
            session(['browser_recommend' => url()->full()]);
        }

        return $next($request);
    }
}
