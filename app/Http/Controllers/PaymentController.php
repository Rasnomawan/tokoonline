<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with('transaction')->get();
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($transaction_id)
    {
        $transaction = Transaction::findOrFail($transaction_id);
        return view('payments.create', compact('transaction'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'amount' => 'required|numeric|min:1',
        ]);

        $transaction = Transaction::findOrFail($request->transaction_id);

        // Hitung total pembayaran saat ini
        $totalPembayaranSebelumnya = $transaction->payment()->sum('amount');
        $totalSekarang = $totalPembayaranSebelumnya + $request->amount;

        // Tentukan status
        $status = $totalSekarang >= $transaction->total_price ? 'Done' : 'Not Done';

        // Simpan pembayaran
        Payment::create([
            'transaction_id' => $transaction->id,
            'amount' => $request->amount,
            'status' => $status,
        ]);

        // Update status transaksi
        $transaction->update([
            'status' => $status,
            'total_payment' => $totalSekarang,
        ]);

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        $transaction = $payment->transaction;
         if (!$transaction) {
        return redirect()->route('transactions.index')->with('error', 'Transaction not found.');
    }
        return view('payments.edit', compact('payment', 'transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $transaction = $payment->transaction;

        // Hitung total pembayaran selain yang sedang diedit
        $totalPembayaranLain = $transaction->payment()->where('id', '!=', $payment->id)->sum('amount');
        $totalBaru = $totalPembayaranLain + $request->amount;

        // Tentukan status baru
        $status = $totalBaru >= $transaction->total_price ? 'Done' : 'Not Done';

        // Update pembayaran
        $payment->update([
            'amount' => $request->amount,
            'status' => $status,
        ]);

        // Update transaksi
        $transaction->update([
            'total_payment' => $totalBaru,
            'status' => $status,
        ]);

        return redirect()->route('payments.index')->with('success', 'payment insert succesfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'payment succesfulyy destroyed.');
    }
}
