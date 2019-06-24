<?php

namespace App\GraphQL\Mutation;

use App\Bit;
use App\Reply;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

class ReplyBitMutation extends Mutation
{
    protected $attributes = [
        'name' => 'ReplyBitMutation',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('Reply');
    }

    public function args()
    {
        return [
            'bit_id' => [
                'name' => 'bit_id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required'],
            ],
            'reply' => [
                'name' => 'reply',
                'type' => Type::nonNull(Type::string()),
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

        $reply = new Reply();
        $reply->user_id = auth()->user()->id;
        $reply->reply = $args['reply'];

        $bit->replies()->save($reply);

        return $reply;
    }
}
