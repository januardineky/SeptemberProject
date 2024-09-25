<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @media (max-width: 768px) {
        .navbar .container {
            flex-wrap: wrap;
        }
        .navbar form {
            width: 100%;
            margin-top: 10px;
        }
        .navbar input[type="search"] {
            width: 100%;
        }
        .navbar input[type="submit"] {
            width: 100%;
        }
    }

    @media (max-width: 576px) {
        .navbar .container {
            flex-direction: column;
        }
        .navbar form {
            margin-top: 20px;
        }
    }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Landing Page</title>
    <link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}">
</head>
<body>
    @include('sweetalert::alert')
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top">
        <div class="container px-4 px-lg-5">
            <div class="d-flex align-items-center">
                <a class="navbar-brand" href="/">Ini Judul</a>
            </div>
            <form class="d-flex" action="/cari" method="POST">
                @csrf
                <input class="form-control me-2" type="search" placeholder="Search" name="cari" aria-label="Search">
                <input class="btn btn-outline-light" value="Cari" type="submit">
            </form>
            <a href="/login" style="text-decoration: none;" class="btn btn-outline-light">
                <i class="bi bi-box-arrow-left"></i>
                Login
            </a>
        </div>
    </nav>
    <section class="py-5">
        <div class="container-fluid px-4 px-lg-5 mt-5" style="padding-bottom: 300px">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($videos as $video)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <iframe allowfullscreen id="player-{{ $video->id }}" width="100%" height="200" src="https://www.youtube.com/embed/{{ $video->video_id }}"></iframe>
                            <div class="card-body p-4">
                                <h6 class="card-title" style="font-size: larger">{{ $video->title }}</h6>
                                <p class="card-text">User : {{ $video->user->name }}</p>
                                <p class="card-text" style="font-size: small">{{ $video->description }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    {{-- <a href="/delete/{{ $video->id }}"><i class="bi bi-trash" style="color: red;" onclick="return window.confirm('Yakin hapus video ini?')"></i></a>
                                    <a href="/edit/{{ $video->id }}"><i class="bi bi-pencil-square" style="color: blue;"></i></a> --}}
                                    <p class="card-text" style="font-size: x-small;">{{ $video->created_at }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
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

        function onPlayerReady(event) {
            event.target.playVideo();
        }

        function onPlayerStateChange(event) {
            if (event.data === YT.PlayerState.ENDED) {
                event.target.seekTo(0);
                event.target.playVideo();
            }
        }
    </script>
</body>
</html>
