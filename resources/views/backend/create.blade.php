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
        <form id="customerForm" action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mt-5">  
                <div class="col-md-2"></div>
                <div class="col-md-8 bgImg p-5">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="profileImg mb-4">
                                <img id="selectedAvatar" src="/backend/asset/images/profile.png" alt="profile pic"
                                    class="rounded-circle" />
                                <label for="customFile2"><i class="fa-solid fa-pen imagePicker p-2"></i></label>
                                <input type="file" name="avatar"  class="form-control d-none" id="customFile2"
                                    onchange="displayProfileImage(event, 'selectedAvatar')" />
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="row">
                                <div class="d-flex profileName">
                                    <h4 id="headerText">John Doe</h4>
                                   <!-- Button trigger modal -->
                                    <a data-bs-toggle="modal" data-bs-target="#textModel">
                                        <i class="fa-solid fa-pen pt-2 imagePickerTow mt-2 ms-4"></i>
                                    </a>

                                   <!-- text Modal -->
                                    <div class="modal fade" id="textModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Name</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="text" name="name" class="form-control" id="textInput" placeholder="Enter text">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="submitBtn">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- text Modal end -->

                                    <div class="qrImage mt-2">
                                        <img src="/backend/asset/images/qr.png" class=" ms-1" alt="qr">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="email" name="email" id="email" class="form-control profileArea" placeholder="EMAIL">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="password" name="password" id="password" class="form-control profileArea" placeholder="PassWord">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-12 mt-5">
                            <div class="d-flex">
                                <label class="profileHeading mt-2">Description</label>
                                <i class="fa-solid fa-pen imagePickerTow pt-2 ms-4"></i>
                            </div>
                            <textarea class="form-control mt-2 profileArea" id="detail" name="detail" placeholder="Born 1915 passed away 2000"
                                id="floatingTextarea2" style="height: 200px"></textarea>
                            <p id="detail_error" class="profilePara">Max Characters: 1500</p>
                        </div> --}}
                        <div class="col-md-12 mt-4">
                            {{-- <div class="d-flex">
                                <label class="profileHeading mt-2">Your images </label>
                                <label for="imagePicker"><i class="fa-solid fa-pen imagePickerTow pt-2 ms-4"></i></label>
                                <input type="file" name="images[]" class="form-control d-none"  accept="image/*" id="imagePicker" multiple>
                            </div>
                            <div class="row mt-4">
                                <div id="profileAreaImg"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 mt-4">
                                     <div class="d-flex">
                                        <label class="profileHeading mt-2">Video</label>
                                        <label for="videoPicker"><i class="fa-solid fa-pen imagePickerTow pt-2 ms-4"></i></label>
                                        <input type="file" name="video" class="form-control d-none" id="videoPicker">
                                    </div>
                                    <div id="videoPreview" style="width: 50% "></div>
                                </div>
                            </div> --}}

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
  
    </div>
@endsection