<?php

namespace App\GraphQL\Types;

use App\Models\Lyric;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class LyricType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Lyric',
        'description' => 'A lyric entry',
        'model' => Lyric::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The ID of the lyric',
            ],
            'artist' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The artist name',
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The song title',
            ],
            'lyrics' => [
                'type' => Type::string(),
                'description' => 'The lyrics content',
            ],
        ];
    }
}