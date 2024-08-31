@extends('layouts.backend')
@section('content')
<div class="container">
    <div class="competitionMainSection">
        <div class="competitionMainBoxes mt-5">
            <h2>COMPETITION 1  |  <span>{{ $competition->name }}</span></h2>
            <div class="competitionMainVideo mt-5">
                <video width="100%" height="auto" controls>
                    <source src="{{ asset($competition->video_path) }}" type="video/mp4" wi>
                    Your browser does not support the video tag.
                </video>
            </div>
            <div class="competitionMainInfo">
                <h2 class="text-center mt-5">How to Enter:</h2>
                <p class="mt-5"><span>Step 1:</span>Like the Video - Click on the links to our TikTok or Instagram and like the video on either platform.
                    Double Entry - Like the video on both TikTok and Instagram for a double entry and a better chance to 
                    win the 1st and 2nd prizes!</p>
                <p class="mt-3"><span>Step 2:</span>Comment for a Chance to Win - Comment something you would like to see in our game. The best idea 
                    comment will win the 3rd prize.</p>
                <p class="mt-3"><span>Step 3:</span> Follow Us - Follow Qrobyte on Instagram or TikTok to complete your entry.</p>

                <label class="mt-5">Don’t miss out on your chance to win big! Enter now and show us your creativity. Good luck!</label>
                 <!-- Conditionally display social media links -->
            </div>
            <div class="competitionMainLinks">
                
                @if($competition->insta_link)
                <p>
                    <label>Instagram Link: </label> <a href="{{ $competition->insta_link }}" target="_blank">{{ $competition->insta_link }}</a>
                </p>
                @endif
    
               @if($competition->tiktok_link)
                <p>
                    <label>Tiktok Link: </label> <a href="{{ $competition->tiktok_link }}" target="_blank">{{ $competition->tiktok_link }}</a>
                </p>
                @endif
    
                @if($competition->youtube_link)
                <p>
                    <label>Youtube Link: </label> <a href="{{ $competition->youtube_link }}" target="_blank">{{ $competition->youtube_link }}</a>
                </p>
                @endif
            </div>
            <div class="d-flex justify-content-between align-items-center flex-wrap mt-5">
                <div class="competitionMainBox position-relative">
                    <span class="position-absolute top-0 end-0">END: 30 AUG 24</span>
                    <div class="mt-5">
                        <img src="{{ asset($competition->prize1_image_path) }}" alt="Prize 1 Image" width="100%" height="300px">
                    </div>
                    <div>
                        <p>PRIZE 1</p>
                    </div>
                </div>
                <div class="competitionMainBox position-relative">
                    <span class="position-absolute top-0 end-0">END: 30 AUG 24</span>
                    <div class="mt-5">
                        <img src="{{ asset($competition->prize2_image_path) }}" alt="Prize 3 Image" width="100%" height="300px">

                    </div>
                    <div>
                        <p>PRIZE 2</p>
                    </div>
                </div>
                <div class="competitionMainBox position-relative">
                    <span class="position-absolute top-0 end-0">END: 30 AUG 24</span>
                    <div class="mt-5">
                        <img src="{{ asset($competition->prize3_image_path) }}" alt="Prize 3 Image" width="100%" height="300px">

                    </div>
                    <div>
                        <p>PRIZE 3</p>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center flex-wrap mt-5">
                <div class="competitionMainBoxInput"><h2>{{$competition->prize1_description }}</h2></div>
                <div class="competitionMainBoxInput"><h2>{{$competition->prize2_description }}</h2></div>
                <div class="competitionMainBoxInput"><h2>{{$competition->prize3_description }}</h2></div>
            </div>

            <div class="competitionMainSocialForm mt-5">
                <div class="socialHeader d-flex justify-content-between align-items-center flex-wrap">
                    <div class="headerBorder"></div>
                    <h2>Enter Here</h2>
                    <div class="headerBorder"></div>
                </div>
                <div class="socialForm">
                    <form action="{{ route('competitions.enter', $competition->id) }}" method="POST">
                        @csrf
                        <div class="row mt-4">                        
                        <div class="col-md-6">
                            <label for="name" class="form-label">NAME</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="ENTER YOUR NAME" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">EMAIL</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="ENTER YOUR EMAIL ADDRESS" required>
                        </div>
                        
                        @if($competition->insta_link)
                            <div class="col-md-6 mt-2">
                                <label for="instagram_name" class="form-label">INSTAGRAM NAME</label>
                                <input type="text" class="form-control" id="instagram_name" name="instagram_name" placeholder="ENTER YOUR INSTAGRAM NAME">
                            </div>
                        @endif
        
                        @if($competition->tiktok_link)
                            <div class="col-md-6 mt-2">
                                <label for="tiktok_name" class="form-label">TIKTOK NAME</label>
                                <input type="text" class="form-control" id="tiktok_name" name="tiktok_name" placeholder="ENTER YOUR TIKTOK USERNAME">
                            </div>
                        @endif
        
                        @if($competition->youtube_link)
                            <div class="col-md-6 mt-2">
                                <label for="youtube_name" class="form-label">YOUTUBE NAME</label>
                                <input type="text" class="form-control" id="youtube_name" name="youtube_name" placeholder="ENTER YOUR YOUTUBE USERNAME">
                            </div>
                        @endif
        
                        <div class="col-md-12 text-center mt-5 d-flex justify-content-center align-items-center">
                            <div class="w-25"></div>
                            <button class="me-3 SubmitBtn" id="submitButton" type="submit" disabled>ENTER</button>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="termsCheck" name="terms" required>
                                <label class="form-check-label" for="termsCheck">
                                    I accept the Terms & Conditions
                                </label>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const termsCheck = document.getElementById('termsCheck');
        const submitButton = document.getElementById('submitButton');

        termsCheck.addEventListener('change', function() {
            if (this.checked) {
                submitButton.removeAttribute('disabled');
                submitButton.style.backgroundColor = '#006837'; // Change to your desired active color
                submitButton.style.color = '#ffff'; // Change to your desired active color
            } else {
                submitButton.setAttribute('disabled', 'true');
                submitButton.style.backgroundColor = '#D9D9D9'; // Change to your desired disabled color
            }
        });
    });
</script>
@endsection