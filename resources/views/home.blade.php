@extends('layouts.admin')

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row">
            <div class="col-sm-6 col-xl-3 chartBox me-3">
                <div class="rounded text-center">
                    <div>
                        <p class="mb-2 pt-3">TOTAL CUSTOMERS</p>
                        <h6 class="mb-0">{{ $customerCount }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 chartBox">
                <div class="rounded text-center">
                    <div>
                        <p class="mb-2 pt-3">COMPETITION ENTRIES </p>
                        <h6 class="mb-0">{{$copetitionUserCount}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->

    {{-- competition section --}}

    <div class="container">
        <div class="row adminCompetition p-4">
            <div class="col-md-6">
                <h2>COMPETITIONS</h2>
            </div>
            <div class="col-md-6 text-end">
                <a href="#">View</a>
            </div>
            <div class="col-md-12">
                <div class="adminCompetitionTable">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Cooper Law</th>
                                <th>Vipin</th>
                                <th>LivingPlus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><label id="labelTd">ENTRIES :<span>100</span></label></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><label id="labelTdTwo">End date : <span>2024-08-30</span></label></td>
                                <td><label id="labelTdTwo">End date : <span>2024-08-30</span></label></td>
                                <td><label id="labelTdTwo">End date : <span>2024-08-30</span></label></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- customer section --}}
    <div class="container">
        <div class="row adminCompetition p-4">
            <div class="col-md-6">
                <h2>CUSTOMERS</h2>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{route('customerIndex')}}">View</a>
            </div>
            <div class="col-md-12">
                <div class="adminCompetitionTable">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>QR</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($customers->isNotEmpty())
                            <tr>
                                <td><img src="/{{ $customers->first()->avatar }}" width="100px"></td>
                                <td class="pt-5">{{ $customers->first()->user->name }}</td>
                                <td class="pt-5">{{ $customers->first()->user->email }}</td> <!-- Adjust the width as needed -->
                                <td class="pt-5">{{ $decryptedPassword[$customers->first()->user->id] }}</td>
                                <td>
                                    {!! Storage::disk('public')->get('qr_codes/' . $customers->first()->user->id . '.svg') !!}
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td colspan="5" class="text-center">No customers found.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
