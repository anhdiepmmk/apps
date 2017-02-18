<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Guard;
use Illuminate\Contracts\Routing\ResponseFactory;

class Admin
{
    protected $auth;

    protected $response;

    public function __construct(Guard $auth, ResponseFactory $response){
        $this->auth = $auth;
        $this->response = $response;
    }

    public function handle($request, Closure $next){

        if ($this->auth->guest()){
            return redirect()->guest('admin/login');
        }

        if($this->auth->check()){
            $admin = 0;
            if ($this->auth->user()->group_id == 1){
                $admin = 1;
            }
            if ($admin == 0){
                return $this->response->redirectTo('/');
            }
            return $next($request);
        }
        return $this->response->redirectTo('/');
    }
}
