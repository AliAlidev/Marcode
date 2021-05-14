@extends('Layouts.app')

@section('content')
    <!-- banner -->
    <div class="banner">
        <div class="container">
            <!-- form content / login area -->
            <div class="login-area">
                <!-- heading -->
                <h3>Sign In, To Your Account</h3>
                <form action="{{ route('login') }}" method="POST" role="form" id="login-form">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="email"
                            value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Password">
                            @error('password]')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="checkbox form-group">
                        <label>
                            <input type="checkbox"> Remember me
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Login</button>
                </form>
            </div>
        </div>
    </div>
    <!-- banner end -->
@endsection
