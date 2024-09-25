<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .card {
    max-width: 500px;
    margin: 0 auto;
}
    </style>
    <link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}">
    <title>Login</title>
</head>
<body>
    @include('sweetalert::alert')
    <section class="vh-100" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <form action="/login/auth" method="POST">
                                @csrf
                                <h2 class="text-center" style="margin-bottom: 30px">Login</h2>
                                <!-- Email input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="email" id="form2Example1" class="form-control" placeholder="Email" name="email"/>
                                </div>

                                <!-- Password input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="password" id="form2Example2" class="form-control" placeholder="Password" name="password"/>
                                </div>

                                <!-- 2 column grid layout for inline styling -->
                                <div class="row mb-4">
                                    <div class="col d-flex justify-content-center">
                                    <p>Don't Have Account?</p><a href="/register">Register</a>
                                </div>

                                <!-- Submit button -->
                                <input type="submit" class="btn btn-primary btn-block mb-4" value="Submit"></input>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
