<?php

namespace App\Http\Middleware;

use Closure;
use Throwable;
use Hashids\Hashids;
use Illuminate\Http\Response;

class IdDehashing {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if ( ! config('hasher.enable') ) {

            return $next($request);    
        }

        try {

            $parameters = $request->route()->parameters();

            foreach ($parameters as $parameter => $value) {

                $request->route()->setParameter($parameter, decode_hashid($value));
            }

        } catch (Throwable $exception) { }
        
        return $next($request);
    }
}
