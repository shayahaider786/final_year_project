@extends('layouts.admin')

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Customer</p>
                        <h6 class="mb-0">{{ $customerCount }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->
    
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">All Customer</h6>
                <a href="">Show All</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            {{-- <th scope="col">Avatar</th> --}}

                            <th scope="col">Name</th>
                            {{-- <th scope="col">Description</th> --}}
                            <th scope="col">Email</th> <!-- Adjust the width as needed -->
                            <th scope="col">Password</th>
                            <th scope="col">QR Code</th>
                            <th scope="col-2" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                        <tr>
                            {{-- <td><img src="/{{ $customer->avatar }}" width="100px"></td> --}}
                            <td>{{ $customer->user->name }}</td>
                            {{-- <td>{{ $customer->detail }}</td> --}}
                            <td style="width: 100px;">{{ $customer->user->email }}</td> <!-- Adjust the width as needed -->
                            <td>{{ $decryptedPassword[$customer->user->id] }}</td>
                            <td>
                                {!! Storage::disk('public')->get('qr_codes/' . $customer->user->id . '.svg') !!}
                            </td>
                            <td colspan="2" class="d-flex align-items-center justify-content-evenly pt-5">
                                <button class="btn btn-info" onclick="downloadSVG('{{ $customer->user->id }}')">Download</button>
                                <form action="{{ route('destroy',$customer->id) }}" method="POST">
                                    {{-- <a class="btn btn-primary" href="{{ route('edit',$customer->id) }}">Edit</a> --}}
                                    @csrf
                                    @method('DELETE')
                
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->

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
