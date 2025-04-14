<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with wallet and transaction data
     */
    public function index()
    {
        // Cek apakah pengguna sudah memiliki username
        $profile = \App\Models\UserProfile::getActive();

        // Jika belum ada profil atau username masih kosong, redirect ke halaman welcome
        if (!$profile || !$profile->username) {
            return redirect()->route('welcome');
        }

        $wallets = Wallet::all();

        // Calculate total balance
        $totalBalance = $wallets->sum('balance');

        // Calculate total income and expense
        $totalIncome = Transaction::where('type', 'income')->sum('amount');
        $totalExpense = Transaction::where('type', 'expense')->sum('amount');

        // Get all transactions with pagination
        $transactions = Transaction::with('wallet')
            ->orderBy('transaction_date', 'desc')
            ->paginate(10);

        return view('dashboard', compact(
            'wallets',
            'totalBalance',
            'totalIncome',
            'totalExpense',
            'transactions',
            'profile'
        ));
    }
}
