<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class VideoController extends Controller
{
    //
    public function createuser(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        Alert::success('Sukses', 'Register Berhasil');
        return redirect('/login');
    }

    public function auth(Request $request)
    {
        $validate = $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);
        if (auth()->attempt($validate)) {
            Alert::success('Sukses', 'Login Berhasil');
            return redirect('/home');
        }
        Alert::error('Error', 'Username atau Password salah');
        return redirect('/login');
    }

    public function landing()
    {
        $videos = Video::with('user')->get();
        return view('landing', compact('videos'));
    }

    public function register()
    {
        return view('register');
    }

    public function home()
    {
        $videos = Video::with('user')->get();
        return view('home', compact('videos'));
    }

    public function logout()
    {
        Auth::logout();
        Alert::success('Sukses', 'Logout Berhasil');
        return redirect('/');
    }

    public function login()
    {
        return view('login');
    }

    public function uploadVideo(Request $request)
    {
        $pattern = '/^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))([a-zA-Z0-9_-]{11})$/i';

        if (!preg_match($pattern, $request->input('youtube_link'))) {
            // return redirect()->back()->withErrors(['youtube_link' => 'Invalid YouTube link']);
            Alert::error('Error', 'Url tidak sesuai');
            return redirect()->back();
        }

        // Extract the video ID from the YouTube link
        $youtubeLink = $request->input('youtube_link');
        $videoId = preg_replace('/.*(?:youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=)([^#\&\?]*).*/i', '$1', $youtubeLink);

        // Create a new Video model instance
        $video = new Video();
        $video->video_id = $videoId;
        $video->title = $request->title;
        $video->description = $request->description;
        $video->user_id = auth()->id(); // Associate the video with the user who uploaded it
        $video->save();
        Alert::success('Sukses', 'Video Berhasil Diupload');
        return redirect('/home');
    }

    public function create()
    {
        return view('input');
    }

    public function search(Request $request)
    {
        $videos = Video::where('title', 'LIKE', '%' . $request->cari . '%')
        ->orWhere('description', 'LIKE', '%' . $request->cari . '%')
        ->orWhereHas('user', function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->cari . '%');
        })
        ->get();
    return view('home', compact('videos'));
    }

    public function cari(Request $request)
    {
        $videos = Video::where('title', 'LIKE', '%' . $request->cari . '%')
        ->orWhere('description', 'LIKE', '%' . $request->cari . '%')
        ->orWhereHas('user', function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->cari . '%');
        })
        ->get();
    return view('landing', compact('videos'));
    }

    public function edit(Request $request)
    {
        $data['video'] = Video::find($request->id);
        return view('edit',$data);
    }

    // public function update(Request $request)
    // {
    //     $youtubeLink = $request->input('youtube_link');
    //     // Validate the YouTube link
    //     if (!preg_match('/^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))([\w\-]{11})$/', $youtubeLink, $matches)) {
    //         // Handle invalid YouTube link
    //         return redirect()->back()->withErrors(['Invalid YouTube link']);
    //     }

    //     // Extract the video ID from the YouTube link
    //     $videoId = $matches[1];

    //     // Create a new Video model instance
    //     $video = Video::where('id', $request->id)->first();
    //     $video->update([
    //         'video_id' => $videoId,
    //         'title' => $request->title,
    //         'description' => $request->description,
    //     ]);

    //     Alert::success('Sukses', 'Video Berhasil Diubah');
    //     return redirect('/home');
    // }

    public function update(Request $request)
{
    $youtubeLink = $request->input('youtube_link');
    // Validate the YouTube link
    $pattern = '/^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))([a-zA-Z0-9_-]{11})$/i';

    if (!preg_match($pattern, $youtubeLink, $matches)) {
        // Handle invalid YouTube link
        Alert::error('Error', 'Url tidak sesuai');
        return redirect()->back();
    }

    // Extract the video ID from the YouTube link
    $videoId = $matches[1];

    // Create a new Video model instance
    $video = Video::where('id', $request->id)->first();
    $video->update([
        'video_id' => $videoId,
        'title' => $request->title,
        'description' => $request->description,
    ]);

    Alert::success('Sukses', 'Video Berhasil Diubah');
    return redirect('/home');
}

    public function delete(Request $request)
    {
        Video::where('id',$request->id)->delete();
        Alert::success('Sukses', 'Video Berhasil Dihapus');
        return redirect('/home');
    }
}
