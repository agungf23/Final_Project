@extends('layouts.guest')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-floating mb-3">
            <input class="form-control" name="email" id="inputEmail" type="email" placeholder="name@example.com" />
            <label for="inputEmail">Email address</label>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" />
            <label for="inputPassword">Password</label>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" name="remember" id="inputRememberPassword" type="checkbox" value="" />
            <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
        </div>
        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
            <a class="small" href="password.html">Forgot Password?</a>
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
@endsection
