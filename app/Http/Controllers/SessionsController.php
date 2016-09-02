<?php

namespace PatrickRose\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;

use PatrickRose\Http\Requests;
use PatrickRose\Http\FlashMessage;
use PatrickRose\Http\Requests\Login;

class SessionsController extends Controller
{

    /**
     * @var \Illuminate\Auth\AuthManager
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
        $this->middleware('guest', ['except' => 'destroy']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make("sessions.login");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Login $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        if ($this->auth->attempt(compact('username', 'password'))) {
            $this->flash->message('Login successful!');
            return redirect()->intended();
        }
        
        $this->flash->message('Incorrect username/password');
        return redirect()->back();
    }

    public function destroy()
    {
        $this->auth->logout();

        $this->flash->message('You are now logged out');

        return redirect('/');
    }
}
