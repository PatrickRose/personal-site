<?php
namespace PatrickRose\Validation;

use InvalidArgumentException;
use Illuminate\Contracts\Validation\Factory as FactoryContract;

abstract class Validator {

    protected $createRules = false;
    protected $updateRules = false;

    /**
     * @var FactoryContract
     */
    protected $factory;

    public function __construct(FactoryContract $factory) {
        $this->factory = $factory;
    }

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
        $validator = $this->factory->make($data, $rules);
        if ($validator->fails()) {
            throw new ValidationException($validator->messages());
        }
    }

}
