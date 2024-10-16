@extends('layouts.admin')

@section('content')
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
                        <th scope="col">Name</th>
                        <th scope="col">email</th>
                        <th scope="col">phone</th> <!-- Adjust the width as needed -->
                        <th scope="col">paln</th>
                        <th scope="col">Pyment status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customersData as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->plan }}</td>
                        <td>{{ $customer->payment_status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>
<!-- Recent Sales End -->
@endsection