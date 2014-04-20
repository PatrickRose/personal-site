<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 19/04/14
 * Time: 21:22
 */

namespace PatrickRose\Validation;


use Validator as V;
use InvalidArgumentException;

abstract class Validator {

    protected $createRules = false;
    protected $updateRules = false;


    public function validateForCreation($item) {
        if (!$this->createRules) {
            throw new InvalidArgumentException("You need to create the creation rules for this class");
        }
        $this->validate($item, $this->createRules);
    }

    public function validateForUpdating($item) {
        if (!$this->updateRules) {
            throw new InvalidArgumentException("You need to create the updating rules for this class");
        }
        $this->validate($item, $this->updateRules);
    }

    private function validate($data, $rules)
    {
        $validator = V::make($data, $rules);
        if ($validator->fails()) {
            throw new ValidationException($validator->errors());
        }
    }

} 