<?php

namespace App\GraphQL\Query;

use App\User;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

class AllUserQuery extends Query
{
    protected $attributes = [
        'name' => 'AllUserQuery',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('User'));
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $users = User::all();

        return $users;
    }
}
