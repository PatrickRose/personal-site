<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 19/04/14
 * Time: 21:41
 */

namespace PatrickRose\Validation;


class BlogValidator extends Validator {

    function __construct() {
        $this->createRules = array(
            'title' => 'required',
            'content' => 'required',
            'slug' => 'required|unique:blogs'
        );
        $this->updateRules = array(
            'title' => 'required',
            'content' => 'required'
        );
    }
}