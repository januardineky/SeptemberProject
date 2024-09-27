<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('asset/favicon.png.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .card {
    max-width: 500px;
    margin: 0 auto;
}
    </style>
    <link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}">
    <title>Register</title>
</head>
<body>
    @include('sweetalert::alert')
    <section class="vh-100" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <form action="/createuser" method="POST">
                                @csrf
                                <h2 class="text-center" style="margin-bottom: 30px">Register</h2>
                                <!-- Name input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="text" id="form2Example1" class="form-control" placeholder="Name" name="name"/>
                                </div>

                                <!-- Email input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="email" id="form2Example2" class="form-control" placeholder="Email" name="email"/>
                                </div>

                                <!-- Password input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="password" id="form2Example2" class="form-control" placeholder="Password" name="password"/>
                                </div>

                                <!-- Submit button -->
                                <input type="submit" style="background-color: #2196F3; width: 100%" class="btn text-white" value="Submit"></input>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
