<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ProjectAuth
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
	    $user = Auth::user();
	    $project = Project::find($request->input('id'));
	    if($project->user_id != $user->id){
		    return redirect('/');
	    }


        return $next($request);
    }
}
