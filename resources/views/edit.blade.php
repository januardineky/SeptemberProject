<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}">
    <style>
        nav{
            background-color: #03A9F4;
        }
    </style>
    <link rel="icon" href="{{ asset('asset/favicon.png.png') }}" type="image/x-icon">
</head>
<body>
    @include('sweetalert::alert')
    <nav class="navbar navbar-expand-sm navbar-dark">
        <div class="container">
            <a href="/home" class="navbar-brand">Ini Judul</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        Edit Video
                    </div>
                    <div class="card-body">
                        <form action="/edit/{{ $video->id }}" method="POST">
                            @csrf
                            <div class="form-group pt-2">
                                <label for="productName">Url Video</label>
                                <input type="text" class="form-control" id="productName" name="youtube_link" placeholder="Enter Url" value="{{ $video->video_id }}">
                            </div>
                            <div class="form-group pt-2">
                                <label for="category">Judul</label>
                                <input type="text" class="form-control" id="category" name="title" placeholder="Enter Title" value="{{ $video->title }}">
                            </div>
                            <div class="form-group pt-2">
                                <label for="price">Deskripsi</label>
                                <input type="text" class="form-control" id="price" name="description" placeholder="Enter Description" value="{{ $video->description }}">
                            </div>
                            <input type="submit" style="background-color: #2196F3" class="btn w-100 btn-block mt-5 text-white" value="SIMPAN"></input>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
<script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>
