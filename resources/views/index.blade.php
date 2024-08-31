@extends('layouts.backend')
@section('content')

    <!-- .header section -->
    <div class="container-fluid header">
        <div class="container">
            <div class="row">
                <div class="col-md-6 .col-sm-12">
                    <div class="left">
                        <h2>WELCOME TO</h2>
                        <div class="text-end pt-3">
                            <span>QROBYTE</span>
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

    {{-- product section --}}
    <div class="container">
        <div class="productSection mt-5">
            <div class="productHeaderSection d-flex justify-content-between align-items-center flex-wrap w-10">
                <div class="headerBorder"></div>
                <h2>OUR PRODUCTS</h2>
                <div class="headerBorder"></div>
                <div class="text-center mt-3">
                    <p>Elevate your experience with Qrobyte’s unique products. Whether you’re aiming to win big in our exciting competitions, make a lasting impression with our sleek business cards, or preserve memories with our custom memory plates, Qrobyte has you covered. Explore our range and find your perfect match today!</p>
                </div>

                <div class="d-flex justify-content-between align-items-center flex-wrap mt-5">
                    <div class="productBox">
                        <h6>COMPETITIONS</h6>
                        <img src="backend/asset/images/giftBox.png" class="pt-4" alt="giftbox" width="70%">
                        <div class="mt-5">
                            <a href="{{route('competitionMain')}}">MORE INFO</a>
                        </div>
                    </div>
                    <div class="productBox">
                        <h6>BUSINESS CARDS</h6>
                        <img src="backend/asset/images/lockImg.png" class="pt-4" alt="lockImg" width="70%">
                        <div class="mt-5">
                            <a href="#">COMING SOON</a>
                        </div>
                    </div>
                    <div class="productBox">
                        <h6>MEMORY PLATES</h6>
                        <img src="backend/asset/images/lockImg.png" class="pt-4" alt="loackImg" width="70%">
                        <div class="mt-5">
                            <a href="#">COMING SOON</a>
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
                <div class="contact mt-5">
                    <div class="d-flex justify-content-between align-items-center flex-wrap w-10">
                        <div class="headerBorder"></div>
                        <h2>CONTACT US</h2>
                        <div class="headerBorder"></div>
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


@endsection