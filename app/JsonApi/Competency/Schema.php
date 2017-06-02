<?php

namespace App\JsonApi\Competency;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'competency';

    /**
     * @var array|null
     */
    protected $attributes = [
        'competency', 'description','icon_url', 'intro_animation_url'
    ];

    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        if (!$resource instanceof \App\Models\Competency) {
            throw new RuntimeException('Expecting a competency model.');
        }
        return [
            'descriptor-traits' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true
            ],
            'descriptors' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true
            ],
             'levels' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true
            ],
        ];
    }

}

