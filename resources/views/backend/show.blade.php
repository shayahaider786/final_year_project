@extends('layouts.backend')
@section('content')
    <div class="container">
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
            <div class="row mt-5">  
                <div class="col-md-2"></div>
                <div class="col-md-8 bgImg p-5">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="profileImg mb-4">
                                <img id="selectedAvatar" src="/{{ $customer->avatar }}" alt="profile pic"
                                    class="rounded-circle" />
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="row">
                                <div class="d-flex profileName">
                                    <h4 >{{ $customer->user->name }}</h4>
                                    <div class="qrImage mt-2">
                                        <img src="/backend/asset/images/qr.png"  data-bs-toggle="modal" data-bs-target="#staticBackdrop" class=" ms-1" alt="qr">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-5">
                            <div class="d-flex">
                                <label class="profileHeading mt-2">Description</label>
                            </div>
                            <textarea class="form-control mt-2 profileArea"  name="detail"
                                id="floatingTextarea2" style="height: 200px">{{ $customer->detail }}</textarea>
                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="d-flex">
                                <label class="profileHeading mt-2">Your images & video</label>
                            </div>
                            <div class="row mt-4">
                                @foreach($customer->images->where('is_public', true) as $image)  <!-- Only public images -->
                                    <div class="col-md-4 col-sm-12 mb-2 usersImgs" data-image-id="{{ $image->id }}">
                                        <img src="/images/{{ $image->imgname }}" class="img-fluid profileArea" alt="Customer Image" width="100%">
                                    </div>
                                @endforeach
                            </div>
                            <div class="row mt-4">
                                @if ($customer->video && $customer->video->is_public) 
                                    <video controls class="img-fluid w-50 profileArea">
                                        <source src="{{ asset($customer->video->path) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @else
                                    <p>No public videos available.</p>
                                @endif
                            </div>
                            @auth
                            @if($customer->user->id == auth()->user()->id || auth()->user()->type == 'admin')
                                <div class="row mt-5">
                                    <div class="submiteButton text-center">
                                        <a href="" type="submit">Submit</a>
                                    </div>
                                </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-3">Scan to view profile</p>
                        <div class="visible-print text-center">
                            {{-- {!! QrCode::size(100)->generate(route('show', $customer->id)) !!} --}}
                            {!! Storage::disk('public')->get('qr_codes/' . $customer->user->id . '.svg') !!}
                        </div>
                        <p class="mt-4">{{ $customer->user->name }}</p>
                    </div>
                </div>
            </div>
        </div>
  
    </div>


      <!-- JavaScript to reload the page after 10 minutes -->
    <script type="text/javascript">
        // Countdown Timer for 10 minutes (600 seconds)
        let timeLeft = 60; // 10 minutes in seconds

        // Create a function that reloads the page when the time is up
        let countdownTimer = setInterval(function() {
            timeLeft--;

            // Check if the time is up, then reload the page
            if (timeLeft <= 0) {
                clearInterval(countdownTimer); // Stop the timer
                location.reload(); // Reload the page
            }
        }, 1000); // Update the countdown every second
    </script>
@endsection