<?php

use PatrickRose\Repositories\BlogRepositoryInterface;
use PatrickRose\Validation\ValidationException;

class BlogsController extends \BaseController {

    /**
     * @var BlogRepositoryInterface
     */
    private $repository;

    public function __construct(BlogRepositoryInterface $blogRepositoryInterface) {
        $this->beforeFilter('auth', array('except' => 'index|show'));
        $this->beforeFilter('csrf', array('on' => 'store|update'));
        $this->repository = $blogRepositoryInterface;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
//        try {
//
//        } catch (ModelValidationException $e) {
//
//        }
	}


    /**
     * Display the specified resource.
     *
     */
	public function show($slug)
	{
        $blog = $this->repository->find($slug);
        return View::make("blog.show", compact('blog'));
		//
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
