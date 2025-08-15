<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lyric;

class LyricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lyric::create(['artist' => 'Adele', 'title' => 'Hello', 'lyrics' => 'Placeholder lyrics...']);
        Lyric::create(['artist' => 'The Beatles', 'title' => 'Hey Jude', 'lyrics' => 'Placeholder lyrics...']);
    }
}
