<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Form</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
        crossorigin="anonymous"
    />
</head>

<body>
    <nav class="navbar bg-primary navbar-dark shadow py-4">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Navbar</span>

            <div class="d-flex">
                <a href="{{ route('index') }}" class="btn btn-link text-light me-2">Login</a>
                <a href="{{ route('show-registration-form') }}" class="btn btn-link text-light">Register</a>
            </div>
        </div>
    </nav>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-5 mx-auto">
                <h1 class="text-center btn-block">Learning API & JSON</h1>
                <div class="card mt-5">
                    <div class="card-body">
                        @auth
                            <h3>Name: {{ auth('web')->user()->name }}</h3>
                            <h3>Email: {{ auth('web')->user()->email }}</h3>
                            <hr />

                            <!-- JSON data button -->
                            <a href="{{ route('json-data') }}" class="btn btn-info mb-2">View JSON Data</a>

                            @if(auth('web')->check())
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="btn btn-dark" type="submit">Logout</button>
                            </form>
                            @elseif(auth('web')->user()->google_id)
                                <!-- Google logout button -->
                                <form action="{{ route('logout-google') }}" method="post">
                                    @csrf
                                    <button class="btn btn-dark" type="submit">Logout Google</button>
                                </form>
                            @elseif(auth('web')->user()->facebook_id)
                                <!-- Facebook logout button -->
                                <form action="{{ route('logout-facebook') }}" method="post">
                                    @csrf
                                    <button class="btn btn-dark" type="submit">Logout Facebook</button>
                                </form>
                            @else
                            <!-- User with unknown ID -->
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="btn btn-dark" type="submit">Logout</button>
                            </form>
                        @endif

                        @else
                            <form method="POST" action="{{ route('login') }}" class="me-2">
                                @csrf
                                <div class="mb-3">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                                </div>
                                <button type="submit" class="btn btn-success mb-2">Login</button>
                            </form>

                            <!-- Google login button -->
                            <a href="{{ route('redirect-google') }}" class="btn btn-danger">Login With Google</a>
                            <!-- Facebook login button -->
                            <a href="{{ route('redirect-facebook') }}" class="btn btn-primary">Login With Facebook</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>


