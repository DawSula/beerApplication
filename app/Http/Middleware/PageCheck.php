<?php

namespace App\Http\Middleware;

use Closure;

class PageCheck
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
        $reqestPage = $request->query('page') ?? null;


        if (!empty($reqestPage) && $reqestPage <1){
            $request->merge(['page' => 1]);
            return redirect($request->fullUrlWithQuery(['page' => '1']));
        }

        return $next($request);
    }
}
