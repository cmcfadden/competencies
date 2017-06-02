<?php

namespace App\Http\Controllers\Api;

use \App\Models\Competency;
use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;

class CompetencyController extends EloquentController
{
    public function __construct()
    {
        parent::__construct(new Competency());
    }
}
