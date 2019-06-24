<?php

namespace App\GraphQL\Query;

use App\Bit;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

class AllBitsQuery extends Query
{
    protected $attributes = [
        'name' => 'AllBitsQuery',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Bit'));
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $fields = $info->getFieldSelection();

        $bits = Bit::query();

        foreach ($fields as $field => $keys) {
            if ($field === 'user') {
                $bits->with('user');
            }

            if ($field === 'replies') {
                $bits->with('replies');
            }

            if ($field === 'likes_count') {
                $bits->with('likes');
            }
        }

        return $bits->latest()->get();
    }
}
