<?php

namespace PatrickRose\Http\Controllers;

use View;

use Illuminate\Http\Request;

use PatrickRose\Repositories\BlogRepositoryInterface;
use PatrickRose\Repositories\TagRepositoryInterface;
use PatrickRose\Validation\ValidationException;
use PatrickRose\Http\Requests;
use PatrickRose\Http\Requests\CreateBlog;
use PatrickRose\Http\Requests\UpdateBlog;
use PatrickRose\Http\FlashMessage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogsController extends Controller
{

    /**
     * @var BlogRepositoryInterface
     */
    private $blogRepository;
    private $tagRepository;

    /**
     * @var FlashMessage
     */
    private $flash;

    public function __construct(
        BlogRepositoryInterface $blogRepository,
        TagRepositoryInterface $tagRepository,
        FlashMessage $flash
    ) {
    
        $this->middleware('admin', ['except' => ['index', 'show']]);
        $this->blogRepository = $blogRepository;
        $this->tagRepository = $tagRepository;
        $this->flash = $flash;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $blogs = $this->blogRepository->all();
        return View::make("blog.index", compact("blogs"));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make("blog.create");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateBlog $request)
    {
        $blog = $this->blogRepository->create($request);

        if ($request->has('tags')) {
            $tags = $this->tagRepository->createMany($request->get('tags'));
            $this->blogRepository->tagPostWithTags($blog, $tags);
        }

        $this->flash->message("Blog post created!");
        
        return redirect()->route("blog.show", $blog->slug);
    }


    /**
     * Display the specified resource.
     *
     */
    public function show($slug)
    {
        try {
            $blog = $this->blogRepository->find($slug);
            $blogs = $this->blogRepository->getOnly(6);
            return View::make("blog.show", compact('blog', 'blogs'));
        } catch (ModelNotFoundException $e) {
            $this->flash->message("Blog post not found");
            return redirect()->route('blog.index');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $slug
     * @return Response
     */
    public function edit($slug)
    {
        try {
            $blog = $this->blogRepository->find($slug);
            $tags = $blog->getTags();
            return View::make('blog.edit', compact('blog', 'tags'));
        } catch (ModelNotFoundException $e) {
            $this->flash->message("Blog post not found");
            
            return redirect()->route('blog.index');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  string  $slug
     * @return Response
     */
    public function update($slug, UpdateBlog $request)
    {
        try {
            $blog = $this->blogRepository->update($slug, $request);
            if ($request->has('tags')) {
                $tags = $this->tagRepository->createMany($request->get('tags'));
                $this->blogRepository->tagPostWithTags($blog, $tags);
            }
        } catch (ModelNotFoundException $e) {
            return redirect()->route('blog.index');
        }

        $this->flash->message("Blog post updated");
        return redirect()->route("blog.show", $blog->slug);
    }

    public function tagged($tag)
    {
        try {
            $blogs = $this->blogRepository->tagged($tag);
        } catch (ModelNotFoundException $e) {
            $this->flash->message('Tag not found');
            return redirect()->route('tag.index');
        }
        $thisTag = explode("/", request()->getPathInfo())[2];
        $allTags = $this->tagRepository->all(false);
        return View::make("blog.tagged", compact('blogs', 'tag', 'thisTag', 'allTags'));
    }
}
