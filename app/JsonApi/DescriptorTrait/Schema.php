<?php

namespace App\JsonApi\DescriptorTrait;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'descriptor-trait';

    /**
     * @var array|null
     */
    protected $attributes = [
        // 'trait_title'=>"Trait Title"
    ];

    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        if (!$resource instanceof \App\Models\DescriptorTrait) {
            throw new RuntimeException('Expecting a competency model.');
        }
        return [
            'competency' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::DATA => $resource->competency
            ],
        ];
	}
}

