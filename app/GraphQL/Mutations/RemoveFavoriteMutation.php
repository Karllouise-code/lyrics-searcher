<?php

namespace App\GraphQL\Mutations;

use App\Models\Favorite;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\Auth;

class RemoveFavoriteMutation extends Mutation
{
    protected $attributes = [
        'name' => 'removeFavorite',
        'description' => 'Remove a favorite lyric',
    ];

    public function type(): Type
    {
        return \GraphQL::type('Favorite');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The ID of the favorite',
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $favorite = Favorite::where('id', $args['id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();
        $favorite->delete();
        return $favorite;
    }
}