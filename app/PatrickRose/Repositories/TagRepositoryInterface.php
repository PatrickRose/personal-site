<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 25/04/14
 * Time: 15:49
 */

namespace PatrickRose\Repositories;


interface TagRepositoryInterface {

    public function find($tag);

    public function create($input);

    public function createMany($input);

    public function all($paginate = true);

}