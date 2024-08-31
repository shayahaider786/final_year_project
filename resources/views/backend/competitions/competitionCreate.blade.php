@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="competitionFormSection">
        <h2>NEW COMPETITION</h2>
        <form action="{{ route('competitions.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="competitionForm">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="name" class="form-label">COMPETITION NAME</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="start_date" class="form-label">START DATE</label>
                            <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="mb-3">
                            <label for="end_date" class="form-label">END DATE</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="description" class="form-label">DESCRIPTION</label>
                            <textarea class="form-control" id="description" name="description" rows="5" placeholder="Insert Description here ..."></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 competitionForm">
                        <div class="mb-3">
                            <label for="video_path" class="form-label">VIDEO</label>
                            <div class="uploaderFile" id="uploaderFile">
                                <div id="video_display" class="media_display"></div>
                                <div class="uploaderBtn" id="uploadVideoBtn" onclick="triggerFileInput('video_path')">
                                    <img src="/backend/asset/images/uploadIcon.png" alt="uploadIcon.png" width="20%">
                                    <span class="mt-2">UPLOAD</span>
                                </div>
                                <input class="form-control" type="file" id="video_path" name="video_path" accept="video/*" onchange="displayMedia(event, 'video_display')">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="prize1_image_path" class="form-label">Prize 1</label>
                            <div class="uploaderFile" id="prize1Uploader">
                                <div id="prize1_display" class="media_display"></div>
                                <div class="uploaderImgBtn" onclick="triggerFileInput('prize1_image_path')">
                                    <img src="/backend/asset/images/uploadIcon.png" alt="uploadIcon.png" width="20%">
                                    <span class="mt-2">UPLOAD</span>
                                </div>
                                <input class="form-control" type="file" id="prize1_image_path" name="prize1_image_path" accept="image/*" onchange="displayMedia(event, 'prize1_display')">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="prize1_description" class="form-label">Prize 1 description</label>
                            <input type="text" class="form-control" placeholder="Insert Description here ..." id="prize1_description" name="prize1_description">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="prize2_image_path" class="form-label">Prize 2</label>
                            <div class="uploaderFile" id="prize2Uploader">
                                <div id="prize2_display" class="media_display"></div>
                                <div class="uploaderImgBtn" onclick="triggerFileInput('prize2_image_path')">
                                    <img src="/backend/asset/images/uploadIcon.png" alt="uploadIcon.png" width="20%">
                                    <span class="mt-2">UPLOAD</span>
                                </div>
                                <input class="form-control" type="file" id="prize2_image_path" name="prize2_image_path" accept="image/*" onchange="displayMedia(event, 'prize2_display')">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="prize2_description" class="form-label">Prize 2 description</label>
                            <input type="text" class="form-control" placeholder="Insert Description here ..." id="prize2_description" name="prize2_description">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="prize3_image_path" class="form-label">Prize 3</label>
                            <div class="uploaderFile" id="prize3Uploader">
                                <div id="prize3_display" class="media_display"></div>
                                <div class="uploaderImgBtn" onclick="triggerFileInput('prize3_image_path')">
                                    <img src="/backend/asset/images/uploadIcon.png" alt="uploadIcon.png" width="20%">
                                    <span class="mt-2">UPLOAD</span>
                                </div>
                                <input class="form-control" type="file" id="prize3_image_path" name="prize3_image_path" accept="image/*" onchange="displayMedia(event, 'prize3_display')">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="prize3_description" class="form-label">Prize 3 description</label>
                            <input type="text" class="form-control" placeholder="Insert Description here ..." id="prize3_description" name="prize3_description">
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="insta_link" class="form-label">Instagram Link</label>
                            <input type="text" class="form-control" id="insta_link" name="insta_link">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="tiktok_link" class="form-label">TikTok Link</label>
                            <input type="text" class="form-control" id="tiktok_link" name="tiktok_link">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="youtube_link" class="form-label">YouTube Link</label>
                            <input type="text" class="form-control" id="youtube_link" name="youtube_link">
                        </div>
                    </div>
                    <div class="submitBtn">
                        <button class="form-control" type="submit">CREATE</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function triggerFileInput(inputId) {
    document.getElementById(inputId).click();
}

function displayMedia(event, displayId) {
    const file = event.target.files[0];
    const displayDiv = document.getElementById(displayId);
    displayDiv.innerHTML = '';

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            if (file.type.startsWith('video/')) {
                const video = document.createElement('video');
                video.src = e.target.result;
                video.controls = true;
                video.style.width = '100%';
                video.style.height = '300px';  
                displayDiv.appendChild(video);
            } else if (file.type.startsWith('image/')) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100%';
                img.style.height = '300px';  
                displayDiv.appendChild(img);
            }
        };
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
