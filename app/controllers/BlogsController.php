<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use PatrickRose\Repositories\BlogRepositoryInterface;
use PatrickRose\Validation\ValidationException;

class BlogsController extends \BaseController {

    /**
     * @var BlogRepositoryInterface
     */
    private $repository;

    public function __construct(BlogRepositoryInterface $blogRepositoryInterface) {
        $this->beforeFilter('auth', array('except' => array('index','show')));
        $this->beforeFilter('csrf', array('on' => array('store','update')));
        $this->repository = $blogRepositoryInterface;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $blogs = $this->repository->all();
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
            $blog = $this->repository->create(Input::all());
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
            $blog = $this->repository->find($slug);
            $blogs = $this->repository->getOnly(6);
            return View::make("blog.show", compact('blog', 'blogs'));
        } catch (ModelNotFoundException $e) {
            return Redirect::route('blog.index')->with('flash_message', "Blog post not found");
        }
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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


}
