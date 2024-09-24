<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    //
    public function home()
    {
        $videos = Video::all();
        return view('home', compact('videos'));
    }

    public function uploadVideo(Request $request)
    {
    $youtubeLink = $request->input('youtube_link');
    // Extract the video ID from the YouTube link
    $videoId = preg_replace('/.*(?:youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=)([^#\&\?]*).*/', '$1', $youtubeLink);
    // Create a new Video model instance
    $video = new Video();
    $video->video_id = $videoId;
    $video->title = $request->title;
    $video->description = $request->description;
    $video->save();
    return redirect('/');
    }

    public function create()
    {
        return view('input');
    }

    public function search(Request $request)
    {
        $videos = Video::where('title','LIKE','%'.$request->cari.'%')->orwhere('description','LIKE','%'.$request->cari.'%')->get();
        return view('home', compact('videos'));
    }
}
