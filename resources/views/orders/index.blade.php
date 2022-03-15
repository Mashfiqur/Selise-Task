@extends('layouts.app')

@section('title')
    Orders
@endsection
@section('content')
<div class="container">
    <div class="row">
        <h3>Cart Items</h3>
        <div class="container mx-5">
            <div class="row">
                <h3>You have {{ $user->orders->count() }} Orders</h3>

               
                <table class="table">

                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Products</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($user->orders as $order)
                            <tr>
                                <td>{{ $order->hash_id }}</td>
                                <td>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td>Title</td>
                                                <td>Price</td>
                                                <td>Quantity</td>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @forelse($order->packages as $package)

                                            <tr>
                                                <td>{{ $package->product->title }}</td>
                                                <td>{{ $package->quantity }}</td>
                                                <td>{{ $package->price }}</td>
                                            </tr>

                                            @empty

                                            @endforelse
                                        </tbody>
                                    </table>
                                </td>
                                <td>{{ $order->status }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Empty Order List</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection