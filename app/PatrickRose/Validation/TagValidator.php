<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 25/04/14
 * Time: 16:14
 */

namespace PatrickRose\Validation;


class TagValidator extends Validator {

    public function __construct() {
        $this->createRules = [
            'tag' => 'required|unique:tags'
        ];
    }

} 