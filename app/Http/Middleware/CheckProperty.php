<?php

namespace App\Http\Middleware;

use Closure;
use App\JudicialRelation;


class CheckProperty
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
        $property = JudicialRelation::where('user_id', $request->user()->id)
            ->where('judicial_id', $request->route('id'))
            ->exists();
        if($property){
            return $next($request);
        }else{
            return redirect('/');
        }
    }
}
