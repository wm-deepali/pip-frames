@extends('layouts.new-master')

@section('title')
    Cart
@endsection

@section('content')
    <section class="featured-area">
        <div class="container py-5">
            <h1 class="text-center font-weight-bold mb-4" style="font-size:2.8rem">Your shopping cart</h1>
            <p class="text-center mb-3" style="font-size:1.1rem;">
                We can produce up to 50 drawings per day. Receive your artwork proof within 24 hours!
                <span style="color:#ff3c78;font-weight:bold;">15/50</span> Spots left
            </p>
            <div class="progress mx-auto mb-4" style="max-width:400px; height:18px;">
                <div class="progress-bar" role="progressbar" style="width:30%;background:#ffb9c9;" aria-valuenow="15"
                    aria-valuemin="0" aria-valuemax="50">
                    <span style="position:absolute;left:50%;transform:translateX(-50%);color:#ff3c78;">15</span>
                </div>
            </div>
            <div class="text-center mb-4">
                <a href="{{ route('checkout') }}" class="btn btn-lg"
                    style="background:#ff3c78;color:#fff;font-size:1.5rem;font-weight:bold;border-radius:25px;padding:14px 40px;box-shadow:0 2px 10px #ff3c7833;">
                    Go to checkout &rarr;
                </a>
            </div>

            <div class="row d-none d-lg-flex font-weight-bold mb-2" style="color:#343434;font-size:1.15rem;">
                <div class="col-2">Product</div>
                <div class="col-5"></div>
                <div class="col-2 text-center">Quantity</div>
                <div class="col-2 text-right">Total</div>
                <div class="col-1"></div>
            </div>

            @forelse ($enrichedCart as $entry)
                @php
                    $cart = $entry['item'];
                    $attributes = $entry['attributes'];
                @endphp

                <div class="row align-items-center py-3 border-bottom">
                    <div class="col-2">
                        @if(!empty($cart['photos'][0]))
                            <img src="{{ asset('storage/' . $cart['photos'][0]) }}" alt="Product image"
                                style="width:90px; border-radius:8px; box-shadow:0 2px 8px #eee;">
                        @else
                            <div
                                style="width:90px; height:110px; background:#f2f2f2; display:flex; align-items:center; justify-content:center; color:#bbb;">
                                No Image
                            </div>
                        @endif
                    </div>
                    <div class="col-5">
                       
                        @foreach ($attributes as $attr)
                            <div style="font-size:1rem; margin-top:3px;">
                                <span style="color:#555;">{{ $attr['name'] }}:</span>
                                <span style="font-weight:600; color:#222;"> {{ $attr['value'] }} </span>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-2 text-center">
                        <form method="POST" action="{{ route('cart.update', ['index' => $loop->index]) }}"
                            class="d-inline-flex align-items-center justify-content-center">
                            @csrf
                            <button type="submit" name="action" value="decrease"
                                class="btn btn-outline-secondary btn-sm px-2">−</button>
                            <input type="text" name="quantity" value="{{ $cart['quantity'] ?? 1 }}" readonly
                                class="form-control form-control-sm text-center mx-2" style="width: 45px;">
                            <button type="submit" name="action" value="increase"
                                class="btn btn-outline-secondary btn-sm px-2">+</button>
                        </form>
                    </div>
                    <div class="col-2 text-right font-weight-bold" style="font-size:1.15rem;">
                        &pound;{{ number_format($cart['total'] ?? 0, 2) }}
                    </div>
                    <div class="col-1 text-right">
                        <a href="{{ route('cart.remove', ['index' => $loop->index]) }}" class="text-danger"
                            title="Remove item">×</a>
                    </div>
                </div>
            @empty
                <div class="text-center py-5" style="font-size:1.3rem; color:#777;">
                    Your cart is empty.
                </div>
            @endforelse
        </div>
        <div class="text-center mt-5">
    <a href="{{ route('home') }}" 
       style="display:inline-block; border-radius:6px; padding:8px 26px; font-size:1.4rem; font-weight:600; box-shadow:0 2px 8px #dcf1fb; color:#11B7D7; text-decoration:underline; position:relative;">
        <span style="color:#ff3b7c; font-size:1.3em; position:relative; top:2px; margin-right:8px;">&#9998;</span>
        Customize a 2nd portrait
    </a>
    <div style="color:#999; font-size:1.07rem; margin-top:4px; font-style:italic;">
        and receive a free digital download
    </div>
</div>

    </section>
@endsection