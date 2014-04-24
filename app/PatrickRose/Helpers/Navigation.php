<?php namespace PatrickRose\Helpers;
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 18/04/14
 * Time: 22:53
 */

use Auth;

class Navigation {

    public static function getLogin() {
        if (Auth::check()) {
            $link = array('Logout', "logout");
        } else {
            $link = array('Login', "login");
        }
        return \Navigation::links(
            array($link)
        );
    }

} 