<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article; // Assuming you have an Article model

class ModulBelajarController extends Controller
{
    public function show($materi)
    {
        // Get articles based on the category (materi)
        $articles = Article::where('category', $materi)
                         ->orderBy('created_at', 'desc')
                         ->get();

        // Get videos (you might have a separate Video model)
        $videos = Article::where('category', $materi)
                        ->where('type', 'video')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('MulaiBelajar.artikel_video', [
            'materi' => $materi,
            'articles' => $articles,
            'videos' => $videos
        ]);
    }
}
