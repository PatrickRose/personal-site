<?php namespace PatrickRose\Helpers;
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 18/04/14
 * Time: 22:53
 */

use Auth;
use HTML;

class Navigation {

    public static function getLogin() {
        if (Auth::check()) {
            $link = HTML::linkRoute("logout", "Logout");
        } else {
            $link = HTML::linkRoute("login", "Login");
        }
        return "
<ul class='nav navbar-nav navbar-right'>
    <li>
        {$link}
    </li>
</ul>";
    }

} 