<?php

namespace PatrickRose\Validation;
use Illuminate\Contracts\Validation\Factory as FactoryContract;

class TagValidator extends Validator {

    public function __construct(FactoryContract $factory) {
        $this->createRules = [
            'tag' => 'required|unique:tags'
        ];

        parent::__construct($factory);
    }

}
