{{-- resources/views/products/preview.blade.php --}}
@extends('layouts.app')

@section('content')
    <h2>Checkout Preview</h2>

    @if($cartItems->isEmpty())
        <p>No items selected for checkout preview.</p>
    @else
        <ul class="list-group mb-4">
            @foreach($cartItems as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <img src="{{ asset('images/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="img-thumbnail" style="width: 50px;">
                    <span>{{ $item->product->name }}</span>
                    <span>Quantity: {{ $item->quantity }}</span>
                    <span>Price: ${{ $item->product->price * $item->quantity }}</span>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
