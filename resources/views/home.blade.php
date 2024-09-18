<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}">
    <style>
        .card {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="/home">Ini Judul</a>
            <form class="d-flex" action="/home/search" method="POST" style="margin-left: 540px">
                @csrf
                <input class="form-control me-2 w-100" type="search" placeholder="Search" name="cari" aria-label="Search">
                <input class="btn btn-outline-light" value="Cari" type="submit"></input>
            </form>
            <a href="/auth/logout" onclick="return window.confirm('Apakah anda ingin Logout?')" style="text-decoration: none" class="btn btn-outline-light">
                <i class="bi bi-box-arrow-right"></i>
                Logout
            </a>
        </div>
    </nav>
    <section class="py-5">
        <div class="container-fluid px-4 px-lg-5 mt-5" style="padding-bottom: 100px">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($videos as $video)
                    <div class="col mb-5">
                        <div class="card h-100 justify-content-center" style="display: flex; justify-content: center; align-items: center;">
                            <iframe allowfullscreen id="player-{{ $video->id }}" width="220" height="200" style="margin-top: 30px" src="https://www.youtube.com/embed/{{ $video->video_id }}"></iframe>
                            <div class="card-body p-4">
                                <h6 class="fw-bolder">{{ $video->title }}</h6>
                                <p class="fw-normal">{{ $video->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <form action="/upload-video" method="POST">
        @csrf
        <input type="text" name="youtube_link" placeholder="Enter YouTube link">
        <input type="text" name="title" placeholder="Enter Title">
        <input type="text" name="description" placeholder="Enter Description">
        <input type="submit">Upload Video</input>
    </form>

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
