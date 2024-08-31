<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{asset('backend/asset/style.css')}}">
    <link rel="stylesheet" href="{{asset('backend/asset/mediaquery.css')}}">
    <title>Qrify</title>
</head>

<body class="main">
       <!-- navbar section -->
       <div class="navBg text-center">
        <div class="d-flex justify-content-between align-items-center">
            <div></div>
            <div>
                <a class="nav-link" href="{{url('/')}}"><img src="/backend/asset/images/logo.png" width="70%" alt=""></a>
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
                            <img src="/backend/asset/images/loginBtn.png" alt="login btn" width="70%">
                        </a>
                    @endauth
                @endif
            </div>
        </div>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <ul class="navbar-nav align-items-center  mb-2 mb-lg-0">
                        <li class="nav-item me-5">
                            <a class="nav-link active" aria-current="page" href="{{url('/')}}">HOME</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" href="#about">OUR PRODUCTS</a>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">CONTACT US</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div>
        @yield('content')
    </div>
        <!-- forter section -->
        <div class="container-fluid">
            <div class="row footer">
                <div class="col-md-4">
                    <img src="/backend/asset/images/loginpic.png" alt="loginPic" width="32%">
                </div>
                <div class="col-md-4 text-center pt-3">
                    <div class="soicalicon">
                        <i class="fa-brands fa-instagram"></i>
                        <i class="fa-brands fa-facebook"></i>
                    </div>
                    <p class="mt-3">info@qrobyte.net | +27 67 753 0785<br>
                        Privacy Policy
                    </p>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous">
</script>

<script>
    $(document).ready(function () {
        $('.togglePassword').click(function () {
            var passwordField = $('#password');
            var passwordFieldType = passwordField.attr('type');
            if (passwordFieldType === 'password') {
                passwordField.attr('type', 'text');
                $('.togglePassword').removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                $('.togglePassword').removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>

<script>
    function displayProfileImage(event, elementId) {
        const selectedImage = document.getElementById(elementId);
        const fileInput = event.target;
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                selectedImage.src = e.target.result;
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
</script>
{{-- multi images --}}
<script>
    document.getElementById('imagePicker').addEventListener('change', function(event) {
        var files = event.target.files;
        var imagePreviewsContainer = document.getElementById('profileAreaImg');
        imagePreviewsContainer.innerHTML = ''; // Clear previous previews

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();
            reader.onload = function(e) {
                var imagePreview = document.createElement('div');
                imagePreview.classList.add('profileAreaImg');
                var img = document.createElement('img');
                img.src = e.target.result;
                imagePreview.appendChild(img);
                imagePreviewsContainer.appendChild(imagePreview);
            };
            reader.readAsDataURL(file);
        }
    });
</script>

{{-- video picker --}}
<script>
    document.getElementById('videoPicker').addEventListener('change', function(event) {
        var file = event.target.files[0]; // Get the first file
        var videoPreviewContainer = document.getElementById('videoPreview');
        videoPreviewContainer.innerHTML = ''; // Clear previous preview

        var reader = new FileReader();
        reader.onload = function(e) {
            var videoPreview = document.createElement('video');
            videoPreview.src = e.target.result;
            videoPreview.controls = true; // Add controls for playback
            videoPreview.style.width = '50%'; // Set the width to 50%
            videoPreviewContainer.appendChild(videoPreview);
        };
        reader.readAsDataURL(file);
    });
</script>

<script>
  // When the submit button is clicked
  document.getElementById("submitBtn").addEventListener("click", function() {
    var inputText = document.getElementById("textInput").value;
    document.getElementById("headerText").innerText = inputText;
  });
</script>

{{-- text size  --}}

<script>
    document.getElementById('customerForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var textareaValue = document.getElementById('detail').value.trim();
        var errorElement = document.getElementById('detail_error');
        errorElement.textContent = '';
        if (textareaValue.length === 0) {
            errorElement.textContent = 'Textarea field is required.';
            return;
        }
        if (textareaValue.length > 1500) {
            errorElement.textContent = 'Textarea field may not be greater than 1500 characters.';
            return;
        }
        this.submit();
    });
</script>


{{-- image deleted --}}
<script>
    // Event delegation for delete buttons
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('deleteBtn')) {
            const imageId = event.target.dataset.imageId;

            // Show the delete confirmation modal
            const modal = document.getElementById(`exampleModal${imageId}`);
            const modalInstance = new bootstrap.Modal(modal);
            modalInstance.show();
        }
    });

    // Delete button click event inside the modal
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('confirmDeleteBtn')) {
            const imageId = event.target.dataset.imageId;

            // Close the modal
            const modal = document.getElementById(`exampleModal${imageId}`);
            const modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();

            // Remove the image container from UI
            const imageContainer = document.querySelector(`[data-image-id="${imageId}"]`);
            if (imageContainer) {
                imageContainer.remove();
            }

            // Send AJAX request to server
            fetch(`/delete-image/${imageId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to delete image');
                }
                console.log('Image deleted successfully');
            })
            .catch(error => {
                console.error(error.message);
            });
        }
    });
</script>

{{-- video deleted --}}
<script>
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('delete-video')) {
            const videoId = event.target.dataset.videoId;
            const confirmation = confirm("Are you sure you want to delete this video?");
            if (confirmation) {
                // Send AJAX request to delete video
                fetch(`/delete-video/${videoId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to delete video');
                    }
                    // Remove the video container from the UI
                    const videoContainer = event.target.closest('.video-container');
                    if (videoContainer) {
                        videoContainer.remove();
                    }
                    console.log('Video deleted successfully');
                })
                .catch(error => {
                    console.error(error.message);
                });
            }
        }
    });
</script>

</html>