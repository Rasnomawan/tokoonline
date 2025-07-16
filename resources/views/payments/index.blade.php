@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Pembayaran</h1>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Transaksi</th>
                <th>Status</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
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
                            <button onclick="return confirm('Yakin ingin menghapus pembayaran ini?')" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data pembayaran.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
