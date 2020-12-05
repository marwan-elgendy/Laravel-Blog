<?php

namespace App\Http\Middleware;

use Closure;

use App\category;

class VerifyCategoriesCount
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
        if(category::all()->count() == 0){
            session()->flash('error','You need to add categories first in order to be able to add posts');
            return redirect(route('categories.create'));
        }
        return $next($request);
    }
}
