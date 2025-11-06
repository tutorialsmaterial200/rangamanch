<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        $videos = Video::with('language')->latest()->paginate(10);
        return view('admin.video-page.index', compact('languages', 'videos'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'video_url' => 'required|url',
            'language_id' => 'required|exists:languages,id',
            'status' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            $video = new Video();
            $video->title = $request->title;
            $video->video_url = $request->video_url;
            $video->language_id = $request->language_id;
            $video->status = $request->status;
            $video->save();

            Session::flash('success', 'Video added successfully!');
            return response()->json([
                'success' => true,
                'message' => 'Video added successfully!',
                'video' => $video
            ]);
        } catch (\Exception $e) {
            Log::error('Video creation error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to add video. Please try again.'], 500);
        }
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        $languages = Language::all();
        return view('admin.video-page.edit', compact('video', 'languages'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'video_url' => 'required|url',
            'language_id' => 'required|exists:languages,id',
            'status' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            $video = Video::findOrFail($id);
            $video->update([
                'title' => $request->title,
                'video_url' => $request->video_url,
                'language_id' => $request->language_id,
                'status' => $request->status,
            ]);

            Session::flash('success', 'Video updated successfully!');
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update video. Please try again.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $video = Video::findOrFail($id);
            $video->delete();
            
            return response()->json(['success' => true, 'message' => 'Video deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete video. Please try again.'], 500);
        }
    }
}
