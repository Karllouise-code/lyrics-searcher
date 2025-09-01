<?php

namespace App\GraphQL\Types;

use App\Models\Favorite;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class FavoriteType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Favorite',
        'description' => 'A favorite lyric',
        'model' => Favorite::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The ID of the favorite',
            ],
            'artist' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The artist name',
                'resolve' => fn ($favorite) => $favorite->lyric ? $favorite->lyric->artist : null,
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The song title',
                'resolve' => fn ($favorite) => $favorite->lyric ? $favorite->lyric->title : null,
            ],
        ];
    }
}