<?php

namespace App\JsonApi\Descriptor;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'descriptor';

    /**
     * @var array|null
     */
    protected $attributes = ['descriptor_text'];

    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        if (!$resource instanceof \App\Models\Descriptor) {
            throw new RuntimeException('Expecting a competency model.');
        }
        return [
            'competency' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::DATA => $resource->competency
            ],
            'level' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::DATA => $resource->level
            ],
            'descriptor_trait' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::DATA => $resource->descriptor_trait
            ]
        ];
	}
}

