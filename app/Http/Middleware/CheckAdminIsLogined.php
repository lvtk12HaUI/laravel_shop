<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminIsLogined
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
        $email = $request->session()->get('email');
        $id = $request->session()->get('id');
        if(!$this->adminIsLogined($id, $email)){
            return redirect()->route('viewLogin');
        }
        return $next($request);
    }

    private function adminIsLogined($id,$email){
        $id = (is_numeric($id) && $id >0) ? true : false;
        $email = empty($email) ? false : true;
        if($id && $email){
            return true;
        }
        return false;
    }
}
