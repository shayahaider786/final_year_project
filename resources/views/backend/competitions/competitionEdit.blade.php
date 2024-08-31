@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="competitionFormSection p-4">
            <h2>EDIT COMPETITION</h2>
            <form action="{{ route('competitionUpdate', $competition->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="competitionForm">
                    <div class="row">
                        <!-- Competition Name -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">COMPETITION NAME</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $competition->name) }}">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
            
                        <!-- Start Date -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="start_date" class="form-label">START DATE</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $competition->start_date)}}">
                                @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
            
                        <!-- End Date -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="end_date" class="form-label">END DATE</label>
                                <input type="date" class="form-control" id="end_date" name="end_date"value="{{ old('end_date', $competition->end_date)}}">
                                @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
            
                        <!-- Description -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="description" class="form-label">DESCRIPTION</label>
                                <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $competition->description) }}</textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
            
                        <!-- Video Path -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="video_path" class="form-label">VIDEO</label>
                                <div class="uploaderFile position-relative" id="videoUploader">
                                    @if($competition->video_path)
                                        <div class="media-display">
                                            <video src="{{ asset('/' . $competition->video_path) }}" controls style="width: 100%; height: 300px; border-radius: 20px;"></video>
                                        </div>
                                    @else
                                        <div class="media-display"></div>
                                    @endif
                                    <img src="/backend/asset/images/editIcon.png" alt="editIcon.png" class="edit-icon" onclick="triggerFileInput('video_path')">
                                    <input class="form-control" type="file" id="video_path" name="video_path" accept="video/*" onchange="displayMedia(event, 'videoUploader')" style="display: none;">
                                </div>
                                @error('video_path') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
            
                        <!-- Prize 1 Image and Description -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="prize1_image_path" class="form-label">Prize 1</label>
                                <div class="uploaderFile position-relative" id="prize1Uploader">
                                    @if($competition->prize1_image_path)
                                        <div class="media-display">
                                            <img src="{{ asset('/' . $competition->prize1_image_path) }}" style="width: 100%; height: 300px; border-radius: 20px;">
                                        </div>
                                    @else
                                        <div class="media-display"></div>
                                    @endif
                                    <img src="/backend/asset/images/editIcon.png" alt="editIcon" class="edit-icon" onclick="triggerFileInput('prize1_image_path')">
                                    <input class="form-control" type="file" id="prize1_image_path" name="prize1_image_path" accept="image/*" onchange="displayMedia(event, 'prize1Uploader')" style="display: none;">
                                </div>
                                @error('prize1_image_path') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="prize1_description" class="form-label">Prize 1 Description</label>
                                <input type="text" class="form-control" id="prize1_description" name="prize1_description" value="{{ old('prize1_description', $competition->prize1_description) }}">
                                @error('prize1_description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
            
                        <!-- Prize 2 Image and Description -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="prize2_image_path" class="form-label">Prize 2</label>
                                <div class="uploaderFile position-relative" id="prize2Uploader">
                                    @if($competition->prize2_image_path)
                                        <div class="media-display">
                                            <img src="{{ asset('/' . $competition->prize2_image_path) }}" style="width: 100%; height: 300px; border-radius: 20px;">
                                        </div>
                                    @else
                                        <div class="media-display"></div>
                                    @endif
                                    <img src="/backend/asset/images/editIcon.png" alt="editIcon" class="edit-icon" onclick="triggerFileInput('prize2_image_path')">
                                    <input class="form-control" type="file" id="prize2_image_path" name="prize2_image_path" accept="image/*" onchange="displayMedia(event, 'prize2Uploader')" style="display: none;">
                                </div>
                                @error('prize2_image_path') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="prize2_description" class="form-label">Prize 2 Description</label>
                                <input type="text" class="form-control" id="prize2_description" name="prize2_description" value="{{ old('prize2_description', $competition->prize2_description) }}">
                                @error('prize2_description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
            
                        <!-- Prize 3 Image and Description -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="prize3_image_path" class="form-label">Prize 3</label>
                                <div class="uploaderFile position-relative" id="prize3Uploader">
                                    @if($competition->prize3_image_path)
                                        <div class="media-display">
                                            <img src="{{ asset('/' . $competition->prize3_image_path) }}" style="width: 100%; height: 300px; border-radius: 20px;">
                                        </div>
                                    @else
                                        <div class="media-display"></div>
                                    @endif
                                    <img src="/backend/asset/images/editIcon.png" alt="editIcon" class="edit-icon" onclick="triggerFileInput('prize3_image_path')">
                                    <input class="form-control" type="file" id="prize3_image_path" name="prize3_image_path" accept="image/*" onchange="displayMedia(event, 'prize3Uploader')" style="display: none;">
                                </div>
                                @error('prize3_image_path') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="prize3_description" class="form-label">Prize 3 Description</label>
                                <input type="text" class="form-control" id="prize3_description" name="prize3_description" value="{{ old('prize3_description', $competition->prize3_description) }}">
                                @error('prize3_description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
            
                        <!-- Instagram Link -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="insta_link" class="form-label mt-1">Instagram Link</label>
                                <input class="form-check-input ms-2 rounded-circle" type="checkbox" id="insta_checkbox" onclick="toggleInput('insta_checkbox', 'insta_link')">
                                <input type="text" class="form-control" id="insta_link" name="insta_link" value="{{ old('insta_link', $competition->insta_link) }}" disabled>
                                @error('insta_link') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
            
                        <!-- TikTok Link -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="tiktok_link" class="form-label mt-1">TikTok Link</label>
                                <input class="form-check-input ms-2 rounded-circle" type="checkbox" id="tiktok_checkbox" onclick="toggleInput('tiktok_checkbox', 'tiktok_link')">
                                <input type="text" class="form-control" id="tiktok_link" name="tiktok_link" value="{{ old('tiktok_link', $competition->tiktok_link) }}" disabled>
                                @error('tiktok_link') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
            
                        <!-- YouTube Link -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="youtube_link" class="form-label mt-1">YouTube Link</label>
                                <input class="form-check-input ms-2 rounded-circle" type="checkbox" id="youtube_checkbox" onclick="toggleInput('youtube_checkbox', 'youtube_link')">
                                <input type="text" class="form-control" id="youtube_link" name="youtube_link" value="{{ old('youtube_link', $competition->youtube_link) }}" disabled>
                                @error('youtube_link') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
            
                        <!-- Submit Button -->
                        <div class="col-md-12">
                            <div class="submitBtn">
                                <button class="form-control" type="submit">UPDATE</button>
                            </div>
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
            const displayDiv = document.getElementById(displayId).querySelector('.media-display');
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
                        img.style.borderRadius = '20px';
                        displayDiv.appendChild(img);
                    }
                }
                reader.readAsDataURL(file);
            }
        }
    </script>

    {{-- for input disable --}}
    <script>
        function toggleInput(checkboxId, inputId) {
            var checkbox = document.getElementById(checkboxId);
            var input = document.getElementById(inputId);
            if (checkbox.checked) {
                input.disabled = false;
            } else {
                input.value = '';
                input.disabled = true;
            }
        }
    </script>
@endsection
