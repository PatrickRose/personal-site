<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 09/06/14
 * Time: 18:16
 */

namespace PatrickRose\Services;


use Illuminate\Session\Store;

class SessionBasket implements BasketService
{

    const SESSION_KEY = "basket";

    /**
     * @var \Illuminate\Session\Store
     */
    private $store;

    function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function add($id)
    {
        if (in_array($id, $this->contents())) {
            throw new BasketException("Item already in basket");
        }

        $this->push($id);
    }

    public function remove($id)
    {
        $basket = array_filter(
            $this->contents(),
            function ($var) use ($id) {
                return $var != $id;
            }
        );

        $this->put($basket);
    }

    public function clear()
    {
        $this->store->forget(static::SESSION_KEY);
    }

    public function contents()
    {
        return (array)$this->store->get(static::SESSION_KEY, array());
    }

    private function put($basket)
    {
        $this->store->put(static::SESSION_KEY, $basket);
    }

    private function push($id)
    {
        $this->store->push(static::SESSION_KEY, $id);
    }
}