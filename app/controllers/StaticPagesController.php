<?php
use PatrickRose\Repositories\BlogRepositoryInterface;

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

    function __construct(BlogRepositoryInterface $blogRepo) {
        $this->blogRepo = $blogRepo;
    }

    public function homePage() {
        $blogs = $this->blogRepo->getOnly(6);
        return View::make("staticpages.home", compact("blogs"));
    }

    public function aboutPage() {
        return View::make('staticpages.about');
    }

    public function gigPage() {
        return View::make('staticpages.gigs');
    }

} 