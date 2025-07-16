<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Products;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with('product', 'customer')->get();
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $product = Products::findOrFail($id);
        $maxstock = $product->stock;
        $customers = Customer::all();
        return view('transactions.create', compact('product', 'maxstock', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_id' => 'required|exists:customers,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        $product = Products::findOrFail($validated['product_id']);

        if ($validated['quantity'] > $product->stock) {
            return redirect()->route('transactions.index')->with('error', 'Stock is insufficient');
        }

        $total = $product->price * $validated['quantity'];

        Transaction::create([
            'product_id' => $validated['product_id'],
            'customer_id' => $validated['customer_id'],
            'quantity' => $validated['quantity'],
            'total_price' => $total,
        ]);

        $product->stock -= $validated['quantity'];
        $product->save();

        return redirect()->route('transactions.index')->with('success', 'Transaction created succesfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
{
    $product = $transaction->product;

   

    $maxstock = $product->stock + $transaction->quantity;

    $customers = Customer::all();

    return view('transactions.edit', compact('transaction', 'product', 'maxstock', 'customers'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_id' => 'required|exists:customers,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        $product = Products::findOrFail($validated['product_id']);

        // Hitung stok dengan menambahkan kembali quantity sebelumnya
        $availableStock = $product->stock + $transaction->quantity;

        if ($validated['quantity'] > $availableStock) {
            return redirect()->route('transactions.index')->with('error', 'Stock is not sufficient to update the transaction.');
        }

        // Update stock
        $product->stock = $availableStock - $validated['quantity'];
        $product->save();

        $transaction->update([
            'product_id' => $validated['product_id'],
            'customer_id' => $validated['customer_id'],
            'quantity' => $validated['quantity'],
            'total_price' => $product->price * $validated['quantity'],
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    try {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction successfully deleted');
    } catch (\Illuminate\Database\QueryException $e) {
        // Cek jika errornya karena constraint foreign key (kode 23000)
        if ($e->getCode() == "23000") {
            return redirect()->route('transactions.index')
                ->with('error', 'The transaction cannot be deleted because it already has a payment..');
        }

        // Untuk error lain, bisa kirim pesan default
        return redirect()->route('transactions.index')
            ->with('error', 'An error occurred while deleting the transaction..');
    }
}


}
