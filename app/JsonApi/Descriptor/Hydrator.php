<?php

namespace App\JsonApi\Descriptor;

use CloudCreativity\LaravelJsonApi\Hydrator\EloquentHydrator;

class Hydrator extends EloquentHydrator
{

    /**
     * @var array|null
     */
    protected $attributes = null;

    /**
     * @var array
     */
    protected $relationships = [
        'competency','descriptor_trait'
    ];

}
