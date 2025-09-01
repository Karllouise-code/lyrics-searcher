<?php

namespace App\GraphQL\Queries;

use App\Models\Favorite;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Illuminate\Support\Facades\Auth;

use Log;
class FavoritesQuery extends Query
{
    protected $attributes = [
        'name' => 'favorites',
        'description' => 'Get user favorites',
    ];

    public function type(): Type
    {
        return Type::listOf(\GraphQL::type('Favorite'));
    }

    public function resolve($root, $args)
    {
        Log::debug(print_r(Auth::user(), true));
        return Favorite::where('user_id', Auth::id())->get();
    }
}