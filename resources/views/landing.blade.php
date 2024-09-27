<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        nav{
            background-color: #03A9F4;
        }
    </style>
    <title>Landing Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}">
    <link rel="icon" href="{{ asset('asset/favicon.png.png') }}" type="image/x-icon">
</head>
<body>
    @include('sweetalert::alert')
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container px-4 px-lg-5">
            <div class="d-flex align-items-center">
                <a class="navbar-brand" href="/home">Ini Judul</a>
            </div>
            <form class="d-flex" action="/cari" method="POST">
                @csrf
                <input class="form-control me-2" type="search" placeholder="Search" name="cari" aria-label="Search">
                <input class="btn btn-outline-light" value="Cari" type="submit">
            </form>
            <a href="/login" style="text-decoration: none;" class="btn btn-outline-light">
                <i class="bi bi-box-arrow-right"></i>
                Login
            </a>
            </div>
        </div>
    </nav>
    <main class="py-5">
        <div class="container-fluid px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($videos as $video)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <div class="card-header">
                                <h6 class="card-title text-center" style="font-size: larger">{{ $video->title }}</h6>
                            </div>
                            <div class="card-body">
                                <iframe allowfullscreen id="player-{{ $video->id }}" width="100%" height="200" src="https://www.youtube.com/embed/{{ $video->video_id }}"></iframe>
                                <p class="card-text" style="font-size: medium">{{ $video->user->name }}</p>
                                <p class="card-text" style="font-size: small">{{ $video->description }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="card-text" style="font-size: x-small;">{{ $video->created_at }}</p>
                                    {{-- <a href="/delete/{{ $video->id }}"><i class="bi bi-trash" style="color: red;" onclick="return window.confirm('Yakin hapus video ini?')"></i></a>
                                    <a href="/edit/{{ $video->id }}"><i class="bi bi-pencil-square" style="color: blue;"></i></a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"></script>
    <script>
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        var players = [];

        function onYouTubeIframeAPIReady() {
            @foreach($videos as $video)
                players.push(new YT.Player('player-{{ $video->id }}', {
                    height: '200',
                    width: '220',
                    videoId: '{{ $video->video_id }}',
                    playerVars: {
                        'autoplay': 1,
                        'controls': 1,
                        'showinfo': 0,
                        'modestbranding': 1,
                        'loop': 1,
                        'playlist': '{{ $video->video_id }}'
                    },
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange
                    }
                }));
            @endforeach
        }
    </script>
</html>
