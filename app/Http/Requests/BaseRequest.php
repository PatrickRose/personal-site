<?php

namespace PatrickRose\Http\Requests;

use Illuminate\Auth\AuthManager;
use Illuminate\Foundation\Http\FormRequest;
use PatrickRose\Http\FlashMessage;

abstract class BaseRequest extends FormRequest
{
    
    /**
     * @var \Illuminate\Auth\AuthManager
     */
    protected $auth;

    /**
     * @var FlashMessage
     */
    protected $flash;

    public function __construct(
        AuthManager $auth,
        FlashMessage $flash
    ) {
    
        $this->auth = $auth;
        $this->flash = $flash;
    }
    
}
