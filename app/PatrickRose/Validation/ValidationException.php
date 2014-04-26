<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 19/04/14
 * Time: 22:49
 */

namespace PatrickRose\Validation;

use Exception;

class ValidationException extends Exception {

    private $errors;

    public function __construct($errors) {
        parent::__construct();
        $this->errors = $errors;
    }
    public function getErrors()
    {
        return $this->errors;
    }

}

