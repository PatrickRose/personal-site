<?php

namespace PatrickRose\Http\Controllers;

use Illuminate\Http\Request;
use View;
use PatrickRose\Repositories\TagRepositoryInterface;
use PatrickRose\Http\Requests;

class TagsController extends Controller
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
        return View::make("tags.index", compact('tags', 'allTags'));
    }
}
