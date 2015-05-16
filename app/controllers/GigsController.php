<?php

use PatrickRose\Repositories\GigRepositoryInterface;

class GigsController extends \BaseController {

    /**
     * @var GigRepositoryInterface
     */
    private $gigRepo;

    public function __construct(GigRepositoryInterface $gigRepo)
    {
        $this->beforeFilter('auth', array('except' => array('index', 'show')));
        $this->beforeFilter('csrf', array('on' => array('store', 'update')));
        $this->gigRepo = $gigRepo;
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $gigs = $this->gigRepo->all();
        return View::make('gigs.index', compact("gigs"));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('gigs.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $this->gigRepo->create(\Input::all());

        return Redirect::route("gigs.index")
            ->with("flash_message", "Gig created");
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
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
