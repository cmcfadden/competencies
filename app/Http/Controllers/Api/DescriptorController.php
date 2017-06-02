<?php

namespace App\Http\Controllers\Api;

use \App\Models\Descriptor;
use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;

class DescriptorController extends EloquentController
{
    public function __construct()
    {
        parent::__construct(new Descriptor());
    }
}
