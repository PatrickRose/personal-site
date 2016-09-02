<?php

namespace PatrickRose\Http\Controllers;

use Illuminate\Http\Request;
use View;
use PatrickRose\Http\Requests;
use PatrickRose\Http\Requests\CreateGig;
use PatrickRose\Http\FlashMessage;
use PatrickRose\Repositories\GigRepositoryInterface;

class GigsController extends Controller
{
    /**
     * @var GigRepositoryInterface
     */
    private $gigRepo;

    /**
     * @var FlashMessage
     */
    protected $flash;

    public function __construct(GigRepositoryInterface $gigRepo,
                                FlashMessage $flash)
    {
        $this->middleware('admin', array('except' => array('index', 'show')));
        $this->gigRepo = $gigRepo;
        $this->flash = $flash;
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
    public function store(CreateGig $request)
    {
        $this->gigRepo->create($request);
        $this->flash->message("Gig created");
        
        return redirect()->route("gigs.index");
    }

}
