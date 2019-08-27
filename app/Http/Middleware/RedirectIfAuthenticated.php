<?php namespace App\Http\Middleware;

use App\Cocktailz;
use App\Http\Controllers\ApplicationController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated {

	/**
	 * Handle an incoming request.
	 *
	 * @param Request $request
	 * @param Closure $next
	 * @param string|null $guard
	 * @return mixed
	 */
	public function handle ( $request, Closure $next, $guard = null ) {

		if ( Auth::guard ( $guard )->check () ) return redirect ( ApplicationController::redirectToAfterLogin );
		return $next( $request );
	}
}
