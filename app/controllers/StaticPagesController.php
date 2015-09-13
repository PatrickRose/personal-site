<?php
use PatrickRose\Repositories\BlogRepositoryInterface;
use PatrickRose\Repositories\GigRepositoryInterface;

/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 19/04/14
 * Time: 16:56
 */

class StaticPagesController extends Controller {

    /**
     * @var PatrickRose\Repositories\BlogRepositoryInterface
     */
    private $blogRepo;

    private $gigRepo;

    function __construct(BlogRepositoryInterface $blogRepo, GigRepositoryInterface $gigRepo) {
        $this->blogRepo = $blogRepo;
        $this->gigRepo = $gigRepo;
    }

    public function homePage() {
        $blogs = $this->blogRepo->getOnly(4);
        return View::make("staticpages.home", compact("blogs"));
    }

    public function aboutPage() {
        return View::make('staticpages.about');
    }

    public function gigPage() {
        $gigs = $this->gigRepo->all();
        return View::make('staticpages.gigs', compact("gigs"));
    }

    public function feedPage() {
        $blogs = $this->blogRepo->all();

        return Response::view('staticpages.rss', compact("blogs"), 200)->header("Content-Type", "application/atom+xml; charset=UTF-8");
    }

} 
