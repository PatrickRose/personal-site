<?php

namespace PatrickRose\Http\Middleware;

use Closure;

use \Illuminate\Auth\AuthManager;
use \PatrickRose\Http\FlashMessage;

class Admin
{

    /**
     * @var AuthManager
     */
    private $auth;

    /**
     * @var FlashMessage
     */
    private $flash;

    public function __construct(AuthManager $auth, FlashMessage $flash)
    {
        $this->auth = $auth;
        $this->flash = $flash;
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
        if (!$this->auth->check()) {
            $this->flash->message("You're not authorised to do that");
            return redirect('login');
        }
        
        return $next($request);
    }
}
