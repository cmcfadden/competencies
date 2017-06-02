<?php

namespace App\JsonApi\Level;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'level';

    /**
     * @var array|null
     */
    protected $attributes = ['level_description', 'level_number'];

    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        if (!$resource instanceof \App\Models\Level) {
            throw new RuntimeException('Expecting a competency model.');
        }
        return [
            'competency' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::DATA => $resource->competency
            ],
            'descriptor' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::DATA => $resource->descriptors
            ],
        ];
	}

}

