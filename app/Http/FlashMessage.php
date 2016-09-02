<?php

namespace PatrickRose\Http;

use Illuminate\Session\Store;

class FlashMessage
{

    /**
     * @var Store
     */
    private $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function message($message)
    {
        $this->store->flash('flash_message', $message);
    }
}
