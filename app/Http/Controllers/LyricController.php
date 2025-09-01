<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lyric;

class LyricController extends Controller
{
    public function getLyrics(Request $request)
    {
        $artist = $request->query('artist');
        $title = $request->query('title');

        // For now, let's return a dummy response or fetch from a simple source
        // In a real application, you would fetch from a lyrics API or database
        $lyricsText = 'Lyrics for ';
        if ($title) {
            $lyricsText .= $title;
        }
        if ($artist) {
            $lyricsText .= ' by ' . $artist;
        }
        $lyricsText .= ' will go here.';

        return response()->json([
            'artist' => $artist,
            'title' => $title,
            'lyrics' => $lyricsText,
        ]);
    }
}