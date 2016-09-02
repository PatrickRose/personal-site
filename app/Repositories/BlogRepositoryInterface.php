<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 19/04/14
 * Time: 20:59
 */

namespace PatrickRose\Repositories;

use PatrickRose\Http\Requests\CreateBlog;
use PatrickRose\Http\Requests\UpdateBlog;

interface BlogRepositoryInterface
{

    public function find($slug);

    public function all();

    public function update($slug, UpdateBlog $input);

    public function delete($id);

    public function create(CreateBlog $input);

    public function getOnly($number = 3);

    public function tagged($tag);

    public function tagPostWithTags($post, $tags = []);
}
