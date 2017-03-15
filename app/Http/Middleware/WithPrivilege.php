<?php

namespace App\Http\Middleware;

use Closure;

class WithPrivilege
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$permissions)
    {
	    $user = $request->user();

	    if (!empty($user)) {
		    $privileges = $user->privileges()->get();
		    foreach ($privileges as $p) {
			    foreach($permissions as $permission) {
				    if ($p->name == $permission) {
					    return $next($request);
				    }
			    }
		    }
	    }

	    return redirect('/login');
    }
}
