@extends('layouts.backend')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-4 col-md-3 col-sm-12"></div>
            <div class="col-lg-4 col-md-6 col-sm-12 ">
                <div class="loginForm-wrapper">
                    <div class="loginForm">
                        <form  method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label for="email" class="form-label formText">USERNAME</label>
                                <input id="email" type="email" class="form-control formInput  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <label class="form-label formText">PASSWORD</label>
                                <div class="d-flex">
                                    <input type="password" class="form-control formInput  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"  id="password" />
                                    <i class="far fa-eye mt-2 togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Submit button -->
                            <div class="text-center mt-5">
                                <button type="Submit" class="btn btn-outline-light formSubmit">SIGN IN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-12"></div>
        </div>
    </div>
@endsection