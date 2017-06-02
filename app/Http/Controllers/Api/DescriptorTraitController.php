<?php

namespace App\Http\Controllers\Api;

use \App\Models\DescriptorTrait;
use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;

class DescriptorTraitController extends EloquentController
{
    public function __construct()
    {
        parent::__construct(new DescriptorTrait);
    }
}
