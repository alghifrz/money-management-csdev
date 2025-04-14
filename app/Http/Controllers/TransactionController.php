<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with('wallet')
            ->orderBy('transaction_date', 'desc')
            ->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'wallet_id' => 'required|exists:wallets,id',
            'type' => 'required|in:income,expense',
            'category' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date',
        ]);

        DB::transaction(function () use ($validated) {
            // Create transaction
            Transaction::create($validated);

            // Update wallet balance
            $wallet = Wallet::findOrFail($validated['wallet_id']);

            if ($validated['type'] === 'income') {
                $wallet->balance += $validated['amount'];
            } else {
                $wallet->balance -= $validated['amount'];
            }

            $wallet->save();
        });

        return Redirect::route('dashboard')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaction = Transaction::findOrFail($id);

        $validated = $request->validate([
            'wallet_id' => 'required|exists:wallets,id',
            'type' => 'required|in:income,expense',
            'category' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date',
        ]);

        DB::transaction(function () use ($transaction, $validated) {
            // Revert old transaction effect on wallet
            $oldWallet = Wallet::findOrFail($transaction->wallet_id);
            if ($transaction->type === 'income') {
                $oldWallet->balance -= $transaction->amount;
            } else {
                $oldWallet->balance += $transaction->amount;
            }
            $oldWallet->save();

            // Apply new transaction effect on wallet
            $newWallet = Wallet::findOrFail($validated['wallet_id']);
            if ($validated['type'] === 'income') {
                $newWallet->balance += $validated['amount'];
            } else {
                $newWallet->balance -= $validated['amount'];
            }
            $newWallet->save();

            // Update transaction
            $transaction->update($validated);
        });

        return Redirect::route('dashboard')->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = Transaction::findOrFail($id);

        DB::transaction(function () use ($transaction) {
            // Revert transaction effect on wallet
            $wallet = Wallet::findOrFail($transaction->wallet_id);
            if ($transaction->type === 'income') {
                $wallet->balance -= $transaction->amount;
            } else {
                $wallet->balance += $transaction->amount;
            }
            $wallet->save();

            // Delete transaction
            $transaction->delete();
        });

        return Redirect::route('dashboard')->with('success', 'Transaksi berhasil dihapus.');
    }
}
