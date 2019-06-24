<?php

namespace App\GraphQL\Mutation;

use App\Bit;
use App\Like;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

class LikeBitMutation extends Mutation
{
    protected $attributes = [
        'name' => 'LikeBitMutation',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return Type::string();
    }

    public function args()
    {
        return [
            'bit_id' => [
                'name' => 'bit_id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required'],
            ],
        ];
    }

    public function authenticated($root, $args, $currentUser)
    {
        return !!$currentUser;
    }

    public function resolve($root, $args)
    {
        $bit = Bit::find($args['bit_id']);

        $like = new Like();
        $like->user_id = auth()->user()->id;
        $bit->likes()->save($like);

        return 'Like successful!';
    }
}
