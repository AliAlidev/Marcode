@extends('Layouts.app')

@section('content')
    <!-- banner -->
    <div class="banner">
        <div class="container">
            <!-- form content / register area -->
            <div class="register-area">
                <!-- heading -->
                <h3>Sign Up, New Account</h3>
                <form action="{{ route('register') }}" method="POST" role="form">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="exampleInputName1" placeholder="Full Name" value="{{ old('name') }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-info">
                                <input type="radio" name="gender" value="Male" value="{{ old('gender') }}"> Male
                            </label>
                            <label class="btn btn-info">
                                <input type="radio" name="gender" value="Female" value="{{ old('gender') }}"> Female
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="exampleInputEmail1" placeholder="Enter email" value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2"
                            placeholder="Re-Password">
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="checkbox form-group">
                        <label>
                            <input type="checkbox" name="agreeConditions"> I agree with all terms and conditions.
                        </label>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-default">SignUp</button>&nbsp;
                        <button type="reset" class="btn btn-default">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- banner end -->
@endsection
