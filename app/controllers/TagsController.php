<?php
use PatrickRose\Repositories\TagRepositoryInterface;

/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 25/04/14
 * Time: 21:30
 */

class TagsController extends \BaseController
{

    /**
     * @var PatrickRose\Repositories\TagRepositoryInterface
     */
    private $tagRepo;

    public function __construct(TagRepositoryInterface $tagRepositoryInterface)
    {
        $this->tagRepo = $tagRepositoryInterface;
    }

    public function index()
    {
        $tags = $this->tagRepo->all();
        $allTags = $this->tagRepo->all(false);
//        dd($tags->toArray());
        return View::make("tags.index", compact('tags', 'allTags'));
    }

}