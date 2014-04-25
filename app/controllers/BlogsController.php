<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use PatrickRose\Repositories\BlogRepositoryInterface;
use PatrickRose\Repositories\TagRepositoryInterface;
use PatrickRose\Validation\ValidationException;

class BlogsController extends \BaseController {

    /**
     * @var BlogRepositoryInterface
     */
    private $blogRepository;
    private $tagRepository;

    public function __construct(
        BlogRepositoryInterface $blogRepositoryInterface,
        TagRepositoryInterface $tagRepositoryInterface
    ) {
        $this->beforeFilter('auth', array('except' => array('index', 'show', 'tagged')));
        $this->beforeFilter('csrf', array('on' => array('store', 'update')));
        $this->blogRepository = $blogRepositoryInterface;
        $this->tagRepository = $tagRepositoryInterface;
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
	public function store()
	{
        try {
            $blog = $this->blogRepository->create(Input::except(array('tags')));

            if (Input::has('tags')) {
                $tags = $this->tagRepository->createMany(Input::get('tags'));
                $this->blogRepository->tagPostWithTags($blog, $tags);
            }
        } catch (ValidationException $validation) {
            return Redirect::back()->withErrors($validation->getErrors())
                ->withInput()->with("flash_message", "That's not a valid blog post");
        }
        return Redirect::route("blog.show", $blog->slug)->with("flash_message", "Blog post created!");
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
            return Redirect::route('blog.index')->with('flash_message', "Blog post not found");
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
            return View::make('blog.edit', compact('blog'));
        } catch(ModelNotFoundException $e) {
            return Redirect::route('blog.index')->with('flash_message', "Blog post not found");
        }
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  string  $slug
     * @return Response
	 */
	public function update($slug)
	{
        try {
            $blog = $this->blogRepository->update($slug, Input::except('tags'));
            if (Input::has('tags')) {
                $tags = $this->tagRepository->createMany(Input::get('tags'));
                $this->blogRepository->tagPostWithTags($blog, $tags);
            }
        } catch (ModelNotFoundException $e) {
            return Redirect::route('blog.index');
        } catch (ValidationException $e) {
            return Redirect::back()->with('flash_message', "That's not a valid blog post")->withInput();
        }
        return Redirect::route("blog.show", $blog->slug)->with('flash_message', "Blog post updated");
    }


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function tagged($tag) {
        try {
            $blogs = $this->blogRepository->tagged($tag);
        } catch (ModelNotFoundException $e) {
            return Redirect::route('tag.index')->with('flash_message', 'Tag not found');
        }
        $thisTag = explode("/", Request::getPathInfo())[2];
        $allTags = $this->tagRepository->all(false);
        return View::make("blog.tagged", compact('blogs', 'tag', 'thisTag', 'allTags'));
    }


}
