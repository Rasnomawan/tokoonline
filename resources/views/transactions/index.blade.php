@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Transaction List</h2>

    {{-- Flash success --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Flash error --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($transactions->isEmpty())
        <p>No transactions found.</p>
    @else
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Customer</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->product->product_name ?? 'Unknown Product' }}</td>
                        <td>{{ $transaction->customer->name ?? 'Unknown Customer' }}</td>
                        <td>{{ $transaction->quantity }}</td>
                        <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('payments.create', $transaction->id) }}" class="btn btn-success btn-sm">Pay</a>
                            <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
