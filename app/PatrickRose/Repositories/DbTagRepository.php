<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 25/04/14
 * Time: 15:51
 */

namespace PatrickRose\Repositories;

use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PatrickRose\Validation\TagValidator;
use PatrickRose\Validation\ValidationException;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use \Tag;

class DbTagRepository implements TagRepositoryInterface {

    public function find($tag)
    {
        $tag = Tag::whereTag($tag)->first();
        if(!$tag) {
            throw new ModelNotFoundException();
        }
        return $tag;
    }

    public function create($input)
    {
        $validator = new TagValidator();
        $validator->validateForCreation($input);
        $tag = new Tag($input);
        if(!$tag->save()) {
            throw new DatabaseConnectionException();
        }
        return $tag;
    }

    public function createMany($input)
    {
        $tags = strpos($input, ",") === false ? [$input] : explode(", ", $input);
        $created = [];
        DB::beginTransaction();
        foreach($tags as $tag) {
            try {
                $created[] = $this->create(['tag' => $tag])->id;
            } catch (ValidationException $e) {
                try {
                    $created[] = $this->find($tag)->id;
                } catch (ModelNotFoundException $e) {
                    DB::rollBack();
                    throw new InvalidArgumentException();
                }
            }
        }
        DB::commit();
        return $created;
    }

    public function all($paginate = true)
    {
        $tags = Tag::orderBy("tag", "desc")->with('posts');
        return $paginate ? $tags->paginate(6) : $tags->get();
    }
}