<?php

namespace PatrickRose\Repositories;

use PatrickRose\Tag;
use PatrickRose\Blog;
use PatrickRose\Http\Requests\CreateBlog;
use PatrickRose\Http\Requests\UpdateBlog;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DbBlogRepository implements BlogRepositoryInterface
{

    public function find($slug)
    {
        $blog = Blog::whereSlug($slug)->with('tags')->first();
        if (!$blog) {
            throw new ModelNotFoundException();
        }
        return $blog;
    }

    public function all()
    {
        return Blog::orderBy('created_at', 'desc')->paginate(6);
    }

    public function update($slug, UpdateBlog $input)
    {
        $blog = $this->find($slug);
        if (!$blog->update($input->except('tags'))) {
            if ($blog->isDirty()) {
                throw new DatabaseConnectionException();
            }
        };
        return $blog;
    }

    public function create(CreateBlog $input)
    {
        $blogContent = $input->only('title', 'content');
        $blog = new Blog($blogContent);
        $blog->makeSlug();
        if (!$blog->save()) {
            throw new DatabaseConnectionException();
        };
        return $blog;
    }

    public function getOnly($number = 3)
    {
        return Blog::orderBy('created_at', 'desc')->limit($number)->get();
    }

    public function tagged($tag)
    {
        $blogs = Blog::whereHas("tags", function ($query) use ($tag) {
            $query->where('tag', '=', $tag);
        })->paginate(6);
        if (count($blogs)) {
            return $blogs;
        }
        throw new ModelNotFoundException();
    }

    public function tagPostWithTags($post, $tags = [])
    {
        $post->tags()->sync($tags);
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
