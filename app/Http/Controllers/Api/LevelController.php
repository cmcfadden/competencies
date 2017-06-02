<?php

namespace App\Http\Controllers\Api;

use \App\Models\Level;
use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;

class LevelController extends EloquentController
{
    public function __construct()
    {
        parent::__construct(new Level());
    }
}
