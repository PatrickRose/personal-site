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
        $links = array(
            array('Home', route('home')),
            array('About', route('about')),
            array('Blog', route('blog.index')),
        );

        if (Auth::check()) {
            $links[] = array('Logout', route('logout'));
        } else {
            $links[] = array('Login', route('login'));
        }

        return $links;
    }

} 