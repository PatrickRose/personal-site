<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 02/06/14
 * Time: 00:35
 */

namespace PatrickRose\Repositories;


interface ShopRepositoryInterface {

    public function create($input);

    public function all($paginate = 18);

} 