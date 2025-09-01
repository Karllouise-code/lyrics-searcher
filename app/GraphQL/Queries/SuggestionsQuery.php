<?php

namespace App\GraphQL\Queries;

use App\Models\Lyric;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class SuggestionsQuery extends Query
{
    protected $attributes = [
        'name' => 'suggestions',
        'description' => 'Get lyric suggestions based on a query',
    ];

    public function type(): Type
    {
        return Type::listOf(\GraphQL::type('Lyric'));
    }

    public function args(): array
    {
        return [
            'query' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The search query',
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $query = $args['query'];
        return Lyric::where('artist', 'like', "%$query%")
            ->orWhere('title', 'like', "%$query%")
            ->limit(5)
            ->get();
    }
}