<?php

namespace App\GraphQL\Type;

use App\GraphQL\Fields\PictureFeild;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class BitType extends BaseType
{
    protected $attributes = [
        'name' => 'BitType',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of a bit'
            ],
            'user' => [
                'type' => Type::nonNull(GraphQL::type('User')),
                'description' => 'The user that posted a bit'
            ],
            'snippet' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The code bit'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Date a bit was created'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Date a bit was updated'
            ],
            'replies' => [
                'type' => Type::listOf(GraphQL::type('Reply')),
                'description' => 'The replies to a bit'
            ],
            'likes_count' => [
                'type' => Type::int(),
                'description' => 'The number of likes on a bit'
            ],
            'picture' => PictureFeild::class
        ];
    }

    protected function resolveCreatedAtField($root, $args)
    {
        return (string) $root->created_at;
    }

    protected function resolveUpdatedAtField($root, $args)
    {
        return (string) $root->updated_at;
    }

    protected function resolveLikesCountField($root, $args)
    {
        return $root->likes->count();
    }
}
