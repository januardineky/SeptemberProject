<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('asset/favicon.png.png') }}" type="image/x-icon">
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

    nav{
            background-color: #03A9F4;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}">
</head>
<body>
    @include('sweetalert::alert')
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container px-4 px-lg-5">
            <div class="d-flex align-items-center">
                <a class="navbar-brand" href="/home">Ini Judul</a>
                <a href="/create" class="text-white ml-2" style="text-decoration: none">Tambah</a>
            </div>
            <form class="d-flex" action="/search" method="POST">
                @csrf
                <input class="form-control me-2" type="search" placeholder="Search" name="cari" aria-label="Search">
                <input class="btn btn-outline-light" value="Cari" type="submit">
            </form>
            <a href="/logout" style="text-decoration: none;" class="btn btn-outline-light" onclick="return window.confirm('Apakah anda ingin Logout?')"">
                <i class="bi bi-box-arrow-right"></i>
                Logout
            </a>
        </div>
    </nav>
    <section class="py-5">
        <div class="container-fluid px-4 px-lg-5 mt-5" style="padding-bottom: 300px">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($videos as $video)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <div class="card-header">
                                <h6 class="card-title text-center" style="font-size: larger">{{ $video->title }}</h6>
                            </div>
                            <iframe allowfullscreen id="player-{{ $video->id }}" width="100%" height="200" src="https://www.youtube.com/embed/{{ $video->video_id }}"></iframe>
                            <div class="card-body p-4">
                                <p class="card-text" style="font-size: medium">{{ $video->user->name }}</p>
                                <p class="card-text" style="font-size: small">{{ $video->description }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    @if(auth()->id() == $video->user_id)
                                        <a href="/delete/{{ $video->id }}"><i class="bi bi-trash" style="color: red;" onclick="return window.confirm('Yakin hapus video ini?')"></i></a>
                                        <a href="/edit/{{ $video->id }}"><i class="bi bi-pencil-square" style="color: blue;"></i></a>
                                    @endif
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
