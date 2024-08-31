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
    <form id="customerForm" action=" {{ route('update', ['customer' => $customer->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Add hidden input fields for each existing image -->
        @foreach($customer->images as $image)
          <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
        @endforeach
        <div class="row mt-5">
            <div class="col-md-2"></div>
            <div class="col-md-8 bgImg p-5">
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="profileImg mb-4">
                            <img id="selectedAvatar" src="/{{ $customer->avatar }}" alt="profile pic"
                                class="rounded-circle" />
                            <label for="customFile2"><i class="fa-solid fa-pen imagePicker p-2"></i></label>
                            <input type="file" name="avatar" class="form-control d-none" id="customFile2"
                                onchange="displayProfileImage(event, 'selectedAvatar')" />
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="d-flex profileName">
                                <h4 id="headerText">{{$customer->user->name}}</h4>
                                <!-- Button trigger modal -->
                                <a data-bs-toggle="modal" data-bs-target="#textModel">
                                    <i class="fa-solid fa-pen pt-2 imagePickerTow mt-2 ms-4"></i>
                                </a>

                                <!-- text Modal -->
                                <div class="modal fade" id="textModel" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Name</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="text" name="name" value="{{ $customer->user->name }}"
                                                    class="form-control" id="textInput" placeholder="Enter text">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                                    id="submitBtn">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- text Modal end -->

                                <div class="qrImage mt-2">
                                    <img src="/backend/asset/images/qr.png" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop" class=" ms-1" alt="qr">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-5">
                        <div class="d-flex">
                            <label class="profileHeading mt-2">Description</label>
                            <i class="fa-solid fa-pen imagePickerTow pt-2 ms-4"></i>
                        </div>
                        <textarea class="form-control mt-2 profileArea" id="detail" name="detail"
                            placeholder="Born 1915 passed away 2000" id="floatingTextarea2"
                            style="height: 200px">{{ $customer->detail }}</textarea>
                        <p id="detail_error" class="profilePara">Max Characters: 1500</p>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="d-flex">
                            <label class="profileHeading mt-2">Your images</label>
                            <label for="imagePicker"><i class="fa-solid fa-pen imagePickerTow pt-2 ms-4"></i></label>
                            <input type="file" name="images[]" class="form-control d-none" id="imagePicker"
                                accept="image/*" multiple>
                        </div>
                        <div class="row mt-4">
                            @foreach($customer->images as $image)
                                <div class="col-md-4 col-sm-12 mb-2 usersImgs" data-image-id="{{ $image->id }}">
                                    <img src="/images/{{ $image->imgname }}" class="img-fluid profileArea" alt="Customer Image" width="100%">
                                    <i class="fa-solid fa-trash trachIcon" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $image->id }}"></i>
                                    <div class="modal fade" id="exampleModal{{ $image->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $image->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel{{ $image->id }}"></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    Are you sure you want <br> to delete this image
                                                    <div class="pt-4">
                                                    <!-- Delete button inside the modal -->
                                                        <div>
                                                            <button type="button" class="confirmDeleteBtn delBtn" data-image-id="{{ $image->id }}">YES</button>
                                                        </div>
                                                        <div class="pt-3">
                                                            <button type="button" class="delBtn" id="delBtnId" data-bs-dismiss="modal">NO</button>   
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div id="profileAreaImg"></div>
                        <div class="row mt-4">
                            <div class="col-md-12 col-sm-12 mt-4">
                                <div class="d-flex">
                                    <label class="profileHeading mt-2">Video</label>
                                    <label for="videoPicker"><i
                                            class="fa-solid fa-pen imagePickerTow pt-2 ms-4"></i></label>
                                    <input type="file" name="video" class="form-control d-none" id="videoPicker">
                                </div>
                                <div class="video-container usersImgs" data-video-path="{{ $customer->video->path }}">
                                    <video controls class="img-fluid w-50 profileArea">
                                        <source src="{{ asset($customer->video->path) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <i class="fa-solid fa-trash videoTrachIcon" data-bs-toggle="modal" data-bs-target="#exampleModal{{$customer->video->path}}"></i>
                                    <div class="modal fade" id="exampleModal{{$customer->video->path}}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $customer->video->path }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel{{ $customer->video->path }}">Delete Video</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    Are you sure you want to delete this video?
                                                    <div class="pt-4">
                                                        <!-- Delete button inside the modal -->
                                                        <div>
                                                            <button type="button" class="confirmDeleteBtn delBtn" data-image-id="{{ $customer->video->path }}">YES</button>
                                                        </div>
                                                        <div class="pt-3">
                                                            <button type="button" class="delBtn" id="delBtnId" data-bs-dismiss="modal">NO</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="videoPreview" style="width: 30% height: 100px"></div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="submiteButton text-center">
                                <button type="submit" class="btn btn-outline-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </form>
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
                    {{-- <a href="#" id="imageLink"><img src="/backend/asset/images/img8.png" alt="img8"
                            width="10%"></a> --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection