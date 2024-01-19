@extends('layouts.template')

@section('title', 'Login Form')

@section('content')
    <div class="card-body">
        @auth
            <h3>Name: {{ auth('web')->user()->name }}</h3>
            <h3>Email: {{ auth('web')->user()->email }}</h3>
            <hr />

            <!-- JSON data button -->
            <a href="{{ route('json-data') }}" class="btn btn-info mb-2">View JSON Data</a>
            <a href="{{ route('change-password') }}" class="btn btn-link">Change Password</a>

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
            @elseif(auth('web')->user()->github_id)
                <!-- GitHub logout button -->
                <form action="{{ route('logout-github') }}" method="post">
                    @csrf
                    <button class="btn btn-dark" type="submit">Logout GitHub</button>
                </form>
            @else
                <!-- User with unknown ID -->
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="btn btn-dark" type="submit">Logout</button>
                </form>
            @endif
        @else
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="me-2">
                @csrf
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="showPassword">
                    <label class="form-check-label" for="showPassword">Show Password</label>
                </div>
                <button type="submit" class="btn btn-success mb-2">Login</button>
            </form>

            <!-- Google login button -->
            <a href="{{ route('redirect-google') }}" class="btn btn-danger">Login With Google</a>
            <!-- Facebook login button -->
            <a href="{{ route('redirect-facebook') }}" class="btn btn-primary">Login With Facebook</a>
            <!-- GitHub login button -->
            <a href="{{ route('redirect-github') }}" class="btn btn-dark mt-2">Login With GitHub</a>
        @endauth
    </div>

    <script>
        const showPasswordCheckbox = document.getElementById('showPassword');
        const passwordInput = document.getElementById('password');

        showPasswordCheckbox.addEventListener('change', function () {
            if (this.checked) {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    </script>
@endsection
