<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoGalleryController extends Controller
{
    public function index()
    {
        $videos = Video::where('status', 1)
                      ->orderBy('created_at', 'desc')
                      ->paginate(12);

        return view('frontend.video-gallery', compact('videos'));
    }
}
