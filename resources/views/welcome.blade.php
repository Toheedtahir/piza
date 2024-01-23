<!-- resources/views/welcome.blade.php -->

@extends('layouts.layout')

@section('content')
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <img src="/img/pizza-house.png" alt="pizza house logo">
        <div class="title m-b-md">
            The North's Best Pizzas
        </div>
        <p class="mssg"> {{ session('mssg') }} </p>

        <!-- Display pizza details from the session if available -->
        @if(session('pizzaDetails'))
            <div class="pizza-details">
                <h3>Your Pizza Details</h3>
                <p>Name: {{ session('pizzaDetails.name') }}</p>
                <p>Type: {{ session('pizzaDetails.type') }}</p>
                <p>Base: {{ session('pizzaDetails.base') }}</p>
                <p>Toppings:</p>
                <ul>
                    @foreach(session('pizzaDetails.toppings') as $topping)
                        <li>{{ $topping }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- {{-- Remove pizza details from the session --}}
            @php
                dump(session('pizzaDetails'));  // Debug: Check session data before removal
                session()->forget('pizzaDetails');
                dump(session('pizzaDetails'));  // Debug: Check session data after removal
            @endphp -->
        @endif

        <a href="{{ route('pizzas.create') }}">Order a pizza</a>
    </div>
</div>
@endsection
