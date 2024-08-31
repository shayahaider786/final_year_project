@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row compitionSection mt-5">
        <div class="col-md-12 text-center">
            <a href="{{route('competitionCreate')}}">+  NEW COMPETITION</a>
        </div>
        @foreach ($competitions as $competition)
        <div class="col-md-12 competitionBox mt-5">
            <div class="row">
                <div class="d-flex justify-content-between align-items-center ">
                    <h2>COMPETITIONS  | <span>{{$competition->name}}</span></h2>
                    <label>End date : <span>{{$competition->end_date}}</span></label>
                </div>
                <div class="mt-5">
                    <p>{{$competition->description}}</p>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div></div>
                    <a href="{{ route('competitionEdit', $competition->id) }}">EDIT</a>
                    <div>
                        <form action="{{ route('competitions.destroy', $competition->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this competition?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none;">
                                <img src="/backend/asset/images/delIcon.png" alt="delIcon" width="70%">
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection