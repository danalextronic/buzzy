<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Admin
{

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($this->auth->user()->usertype == 'Admin' || $this->auth->user()->usertype == 'Staff') {
            return $next($request);
        } else {
            if ($request->ajax()) {
                return array('errors', 'You are not an Admin..');
            } else {
                \Session::flash('error.message',  'You have no permission for this!');
                return redirect('/');
            }
        }
    }
}
