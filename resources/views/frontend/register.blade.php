@extends('layouts.frontend')

@section('content')
    <!-- contact section -->
    <section class="contact_section layout_padding-bottom" id="contact">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>Register Form</h2>
            </div>

            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto">
                    <div class="form_container">
                        <!-- Display Success Message -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Display Validation Errors -->
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Registration Form -->
                        <form action="{{ route('customer.store') }}" method="POST" id="payment-form">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="plan">Select Plan:</label>
                                <select class="form-control" id="plan" name="plan" required>
                                    <option value="startup" {{ old('plan') == 'startup' ? 'selected' : '' }}>Startup</option>
                                    <option value="standard" {{ old('plan') == 'standard' ? 'selected' : '' }}>Standard</option>
                                    <option value="business" {{ old('plan') == 'business' ? 'selected' : '' }}>Business</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="payment_method">Payment Method:</label>
                                <select class="form-control" id="payment_method" name="payment_method" required>
                                    <option value="stripe">Stripe</option>
                                    <option value="paypal">PayPal</option>
                                </select>
                            </div>

                            <!-- Stripe Elements -->
                            <div id="card-element" class="form-group d-none">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>
                            <div id="card-errors" role="alert"></div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stripe JS -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var stripe = Stripe('{{ config('services.stripe.key') }}');
            var elements = stripe.elements();
            
            var cardElement = elements.create('card');
            var cardElementContainer = document.getElementById('card-element');
            var paymentMethodSelect = document.getElementById('payment_method');
            var form = document.getElementById('payment-form');

            paymentMethodSelect.addEventListener('change', function() {
                if (paymentMethodSelect.value === 'stripe') {
                    cardElementContainer.classList.remove('d-none');
                    cardElement.mount('#card-element');
                } else {
                    cardElementContainer.classList.add('d-none');
                    cardElement.unmount();
                }
            });

            form.addEventListener('submit', function(event) {
                if (paymentMethodSelect.value === 'stripe') {
                    event.preventDefault();
                    
                    stripe.createToken(cardElement).then(function(result) {
                        if (result.error) {
                            var errorElement = document.getElementById('card-errors');
                            errorElement.textContent = result.error.message;
                        } else {
                            var hiddenInput = document.createElement('input');
                            hiddenInput.setAttribute('type', 'hidden');
                            hiddenInput.setAttribute('name', 'stripeToken');
                            hiddenInput.setAttribute('value', result.token.id);
                            form.appendChild(hiddenInput);
                            
                            form.submit();
                        }
                    });
                }
            });
        });
    </script>
@endsection
