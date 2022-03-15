@extends('layouts.app')

@section('title')
    Carts
@endsection
@section('content')
<div class="container">
    <div class="row">
        <h3>Cart Items</h3>
        <div class="container mx-5">
            <div class="row">
                <h3>You have {{ $user->cart_items->count() }} Items in the cart</h3>

                <form action="{{ route('orders.store')}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-secondary">Place Order</button>
                </form>
                <table class="table">

                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($user->cart_items as $item)
                            <tr>
                                <td>{{ $item->product->title }}</td>
                                <td>{{ $item->product->price }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>
                                    <form action="{{ route('carts.destroy', ['id' => $item->hash_id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-primary">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Empty Cart</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection