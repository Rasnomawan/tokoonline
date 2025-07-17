@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
             <div class="col-md-12">
    {{-- Error dari session --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

      @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

    {{-- Error dari validasi (misal: $errors->any()) --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
    <h1 class="mb-4">Daftar Pembayaran</h1>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Transaksi</th>
                <th>Status</th>
                <th>ALL</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $payment->transaction_id }}</td>
                    <td>
                    @php
                                    $status = strtolower($payment->status);
                                    $badge=match($status){
                                                                
                                        'unpaid' => 'bg-yellow-400 text-yellow-800',
                                        'done' => 'bg-green-400 text-green-800',
                                        'not done' =>  'bg-red-600 text-black'
                                    }
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $badge }}">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </td>
                    <td>Rp{{ number_format($payment->amount, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('are you sure to delete this?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">no data payment.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

    </div>
@endsection
