<?php

namespace App\GraphQL\Mutations;

use App\Models\Favorite;
use App\Models\Lyric;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\Auth;

class AddFavoriteMutation extends Mutation
{
    protected $attributes = [
        'name' => 'addFavorite',
        'description' => 'Add a lyric to favorites',
    ];

    public function type(): Type
    {
        return \GraphQL::type('Favorite');
    }

    public function args(): array
    {
        return [
            'artist' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The artist name',
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The song title',
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $lyric = Lyric::firstOrCreate([
            'artist' => $args['artist'],
            'title' => $args['title'],
        ], [
            'lyrics' => '', // Placeholder; fetch lyrics via Lyrics.ovh if needed
        ]);

        $favorite = Favorite::firstOrCreate([
            'user_id' => Auth::id(),
            'lyric_id' => $lyric->id,
        ]);

        return $favorite;
    }
}