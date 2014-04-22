<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 19/04/14
 * Time: 21:04
 */

namespace PatrickRose\Repositories;

use Blog;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PatrickRose\Validation\BlogValidator;

class DbBlogRepository implements BlogRepositoryInterface {

    public function find($slug)
    {
        $blog = Blog::whereSlug($slug)->first();
        if(!$blog) {
            throw new ModelNotFoundException();
        }
        return $blog;
    }

    public function all()
    {
        return Blog::orderBy('created_at', 'desc')->paginate(6);
        // TODO: Implement all() method.
    }

    public function update($id, $blog)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function create($input)
    {
        $blog = new Blog($input);
        $blog->slug = $blog->makeSlug();
        $validator = new BlogValidator();
        $validator->validateForCreation($blog->toArray());
        if (!$blog->save()) {
            throw new DatabaseConnectionException();
        };
        return $blog;
    }

    public function getOnly($number = 3)
    {
        return Blog::orderBy('created_at', 'desc')->limit($number)->get(array("title"));
    }
}