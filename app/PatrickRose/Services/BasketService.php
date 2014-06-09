<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 09/06/14
 * Time: 18:14
 */

namespace PatrickRose\Services;


interface BasketService {

    public function add($id);

    public function remove($id);

    public function clear();

    public function contents();

}