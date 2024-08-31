@extends('layouts.backend')
@section('content')
<div class="container">
    <div class="competitionMainSection">
        <div class="text-center mt-5">
            <p>Dive into our exciting competitions for 
                a chance to win incredible prizes!</p>
        </div>
        @foreach ($competitions as $competition)
        <div class="competitionMainBoxes mt-5">
            <h2>COMPETITION 1  |  <span>{{ $competition->name }}</span></h2>
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
                        <img src="{{ asset($competition->prize2_image_path) }}" alt="Prize 1 Image" width="100%" height="300px">
                    </div>
                    <div>
                        <p>PRIZE 2</p>
                    </div>
                </div>
                <div class="competitionMainBox position-relative">
                    <span class="position-absolute top-0 end-0">END: 30 AUG 24</span>
                    <div class="mt-5">
                        <img src="{{ asset($competition->prize3_image_path) }}" alt="Prize 1 Image" width="100%" height="300px">
                    </div>
                    <div>
                        <p>PRIZE 3</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5 mb-3">
                <a href="{{ route('competitionInfo', ['id' => $competition->id]) }}">MORE INFO</a>
                    </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection