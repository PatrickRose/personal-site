<?php

use PatrickRose\Repositories\ShopRepositoryInterface;

class ShopController extends BaseController {

    /**
     * @var PatrickRose\Repositories\ShopRepositoryInterface
     */
    private $repo;

    function __construct(ShopRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
	 * Display a listing of the resource.
	 * GET /shop
	 *
	 * @return Response
	 */
	public function index()
	{
        $items = $this->repo->all();

        return View::make('shop.index', compact('items'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /shop/create
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('shop.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /shop
	 *
	 * @return Response
	 */
	public function store()
	{
        $this->repo->create(Input::all());

        return Redirect::route("shop.index");
	}

	/**
	 * Display the specified resource.
	 * GET /shop/{id}
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
	 * GET /shop/{id}/edit
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
	 * PUT /shop/{id}
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
	 * DELETE /shop/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}