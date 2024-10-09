@extends('layouts.backend')
@section('content')
   <!-- navbar section -->
    <div class="navBg">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto align-items-center  mb-2 mb-lg-0">
                        <li class="nav-item me-5">
                            <a class="nav-link active" aria-current="page" href="{{url('/')}}">HOME</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" href="#about">ABOUT</a>
                        </li>
                        <li class="nav-item text-center">
                            <a class="nav-link" href="{{url('/')}}"><img src="backend/asset/images/logo.png" width="70%" alt=""></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">CONTACT US</a>
                        </li>
                    </ul>
                </div>
                <div> 
                    @if (Route::has('login'))
                        @auth
                        <ul class="navbar-nav">
                            @if (Auth::user()->isAdmin())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/adminhome') }}">Home</a>
                                </li>
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                            @endif
                        @else
                            <a class="nav-link" href="{{ route('login') }}">
                                <img src="backend/asset/images/loginBtn.png" alt="login btn" width="70%">
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </nav>
    </div>
    <!-- .header section -->
    <div class="container-fluid header">
        <div class="container">
            <div class="row">
                <div class="col-md-6 .col-sm-12">
                    <div class="left">
                        <h2>WELCOME TO</h2>
                        <div class="text-end pt-3">
                            <span>QR Media Hub</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 .col-sm-12">
                    <img src="backend/asset/images/img5.png" alt="image 5">
                </div>
            </div>
        </div>
    </div>
    <!-- about section -->
    <div class="container" id="about">
        <div class="row mt-5">
            <div class="col-md-12 text-center">
                <div class="about">
                    <h2>ABOUT US</h2>
                    <div class="row">
                        <div class="col-md-8">
                            <img src="backend/asset/images/img6.png" alt="img6" width="100%">
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12 container">
                            <span>WELCOME TO QROBYTE</span>
                            <P>We are a dynamic digital company dedicated to capturing and preserving the beautiful
                                moments of your loved ones, ensuring they last a lifetime.
                            </P>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact section -->
    <div class="container" id="contact">
        <div class="row mt-5">
            <div class="col-md-12 text-center">
                <div class="contact">
                    <h2>CONTACT US</h2>
                    <div class="row">
                        <div class="col-md-5"></div>
                        <div class="col-md-7">
                            <img src="backend/asset/images/img7.png" alt="imgy" width="100%">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <P>Feel free to reach out to us at any time! Whether you have questions, suggestions, or
                                just want to say hello, our team is here to assist you. You can contact us through
                                the provided form on our website, or directly via email at example@email.com
                            </P>
                            <div class="soicalicon">
                                <i class="fa-brands fa-instagram"></i>
                                <i class="fa-brands fa-facebook"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-2 col-sm-12"></div>
                        <div class="col-md-8 col-sm-12">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('contact.store') }}" method="POST" id="contactUSForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="text" name="name" class="form-control formInput" placeholder="NAME">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="text" name="surname" class="form-control formInput" placeholder="SURNAME">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="email" name="email" class="form-control formInput" placeholder="EMAIL">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <textarea class="form-control formInput" name="message" placeholder="MESSAGE"
                                                rows="7"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <button type="submit"
                                            class="btn btn-outline-light submiteButton">SUBMIT</button>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2 col-sm-12"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- forter section -->
    <div class="container-fluid">
        <div class="row footer">
            <div class="col-md-4">
                <img src="backend/asset/images/loginpic.png" alt="loginPic" width="32%">
            </div>
            <div class="col-md-4 text-center pt-3">
                <div class="soicalicon">
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-facebook"></i>
                </div>
                <p class="mt-3">example@email.com | 0123456789 <br>
                    Privacy Policy
                </p>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

@endsection