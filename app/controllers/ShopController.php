<?php

use Illuminate\Session\Store;
use PatrickRose\Repositories\ShopRepositoryInterface;
use PatrickRose\Services\BasketException;
use PatrickRose\Services\BasketService;

class ShopController extends BaseController {

    /**
     * @var PatrickRose\Repositories\ShopRepositoryInterface
     */
    private $repo;
    /**
     * @var PatrickRose\Services\BasketService
     */
    private $basketService;

    function __construct(ShopRepositoryInterface $repo, BasketService $basketService)
    {
        $this->repo = $repo;
        $this->basketService = $basketService;
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

    public function buy($id)
    {
        try {
            $this->basketService->add($id);
            return Redirect::route("shop.index")->with('flash_message', 'Item added to basket');
        } catch (BasketException $e) {
            return Redirect::route("shop.index")->with('flash_message', 'Already in basket');
        }
    }

    public function basket()
    {
        $basket = $this->basketService->contents();
        $items = $this->repo->getOnly($basket);
        $totalPrice = 0;
        foreach($items as $item) {
            $totalPrice += $item->price;
        }
        $total = new Shop(["title" => "Total", "price" => $totalPrice]);
        return View::make('shop.basket', compact('items', 'total'));
    }

    public function emptyBasket()
    {
        $this->basketService->clear();

        return Redirect::back()->with('flash_message', "Basket emptied");;
    }

    public function removeItem($id)
    {
        $this->basketService->remove($id);

        return Redirect::back()->with('flash_message', "Item removed");
    }

}