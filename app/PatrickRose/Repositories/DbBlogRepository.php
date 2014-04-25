<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 19/04/14
 * Time: 21:04
 */

namespace PatrickRose\Repositories;

use Tag;
use Blog;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PatrickRose\Validation\BlogValidator;

class DbBlogRepository implements BlogRepositoryInterface {

    public function find($slug)
    {
        $blog = Blog::whereSlug($slug)->with('tags')->first();
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

    public function update($slug, $input)
    {
        $validator = new BlogValidator();
        $validator->validateForUpdating($input);
        $blog = $this->find($slug);
        if (!$blog->update($input)) {
            throw new DatabaseConnectionException();
        };
        return $blog;
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

    public function tagged($tag)
    {
        return Blog::whereHas("tags", function($query) use($tag) {
            $query->where('tag', '=', $tag);
        })->paginate(6);
    }

    public function tagPostWithTags($post, $tags = [])
    {
        $post->tags()->sync($tags);
    }
}