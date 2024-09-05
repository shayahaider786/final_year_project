@extends('layouts.backend')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-2"></div>
            <div class="col-md-8 bgImg p-5">
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="profileImg mb-4">
                            <img id="selectedAvatar" src="/backend/asset/images/profile.png" alt="profile pic"
                                class="rounded-circle" />
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="d-flex profileName">
                                <h4>ADMIN </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="genrateBox">
                            <img src="/backend/asset/images/qr2.png" alt="qr2" width="50%">
                            <div class="genratePara">
                                <label>USERNAME: XXXX</label><br>
                                <label>PASSWORD: 123456</label>
                            </div>
                            <div class="genrateBtn">
                                <a href="#">GENERATE <img src="/backend/asset/images/img3.png" class="mb-2" alt="img3" width="7%"></a>
                                <div id="gtBtn">
                                    <a href="#">SHARE <img src="/backend/asset/images/img4.png" class="pb-2" alt="img4" width="5%"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2 col-sm-12"></div>
                            <div class="col-md-8 col-sm-12 d-flex">
                                <div class="clientOrderBtn">
                                    <label>CLIENTS <br><span>1299</span></label>
                                </div>
                                <div class="clientOrderBtn ms-3">
                                    <label>ORDER NUMBER <br> <span>1309</span></label>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection