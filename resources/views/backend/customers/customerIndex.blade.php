@extends('layouts.admin')

@section('content')
     {{-- customer section --}}
     <div class="container">
        <div class="customerLink text-center mt-4">
            <a href="{{route('create')}}">+  NEW CUSTOMER</a>
        </div>
        <div class="row adminCompetition p-4">
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                            <tr class="borderBottom">
                                <td class=""><img src="/{{ $customer->avatar }}" width="100px"></td>
                                <td class="pt-5">{{ $customer->user->name }}</td>
                                <td class="pt-5">{{ $customer->user->email }}</td> <!-- Adjust the width as needed -->
                                <td class="pt-5">{{ $decryptedPassword[$customer->user->id] }}</td>
                                <td class="p-2">
                                    {!! Storage::disk('public')->get('qr_codes/' . $customer->user->id . '.svg') !!}
                                </td>
                                <td class="pt-3">
                                    <div class="actionBtn">
                                        <h3>GRAVESTONE</h3>
                                        <div class="actionsBtns d-flex justify-content-evenly align-items-center">
                                            <a href="{{ route('edit', $customer->id) }}">
                                                <img src="/backend/asset/images/editIcon.png" alt="editIcon">
                                            </a>
                                            <a href="javascript:void(0);" onclick="downloadSVG('{{ $customer->user->id }}')">
                                                <img src="/backend/asset/images/downloadIcon.png" alt="downloadIcon">
                                            </a>
                                            <form action="{{ route('destroy', $customer->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="border:none; background:none; padding:0;">
                                                    <img src="/backend/asset/images/deleteIcon.png" alt="deleteIcon">
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
        function downloadSVG(userId) {
            // Retrieve SVG data using AJAX
            fetch('/download-svg/' + userId)
                .then(response => response.blob())
                .then(blob => {
                    // Create a temporary URL for the blob
                    const url = URL.createObjectURL(blob);

                    // Create a temporary anchor element to trigger download
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = 'image.svg';

                    // Programmatically trigger click event on the anchor element
                    a.click();

                    // Cleanup: Remove the temporary anchor and revoke the URL
                    URL.revokeObjectURL(url);
                });
        }
    </script>
@endsection