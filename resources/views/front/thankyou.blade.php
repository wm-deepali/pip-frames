@extends('layouts.new-master')

@section('title', 'Thank You')

@section('content')
    <section class="featured-area">
        <div class="container py-5 text-center">
            <h1 class="mb-4">Thank You for Your Order!</h1>
            <p>Your order has been placed successfully. We will process it shortly.</p>
            <a href="{{ url('/') }}" class="btn btn-primary mt-3">Return to Home</a>
        </div>

    </section>
@endsection