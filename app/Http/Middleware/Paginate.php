<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Paginate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // return $next($request);
        $response = $next($request);

        $data = $response->getData(true);

        if(isset($data['meta'],$data['meta']['links'])){
            unset($data['meta']['links']);
        }

        if(isset($data['links'])){
            unset($data['links']);
        }

        $response->setData($data);

        return $response;
    }
}
