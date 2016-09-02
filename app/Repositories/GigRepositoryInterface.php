<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 02/05/14
 * Time: 22:05
 */

namespace PatrickRose\Repositories;
use PatrickRose\Http\Requests\CreateGig;

interface GigRepositoryInterface
{

    public function all();

    public function create(CreateGig $input);
}
