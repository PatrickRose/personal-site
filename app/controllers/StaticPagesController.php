<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 19/04/14
 * Time: 16:56
 */

class StaticPagesController extends Controller {

    public function homePage() {
        return View::make("staticpages.home");
    }

} 