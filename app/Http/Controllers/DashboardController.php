<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $month = Carbon::now()->format('Y-m');

        $transactions = Transaction::where('created_at', 'like', "$month%")
            ->with(['transactionDetail.product'])
            ->get();

        $transactionData = $transactions->groupBy(function ($transaction) {
            return Carbon::parse($transaction->created_at)->format('Y-m-d');
        })->map(function ($transactions, $date) {
            return [
                'date' => Carbon::parse($date)->translatedFormat('d F Y'), 
                'total_transactions' => $transactions->count()
            ];
        })->values();

        $productSales = $transactions->flatMap->transactionDetail
            ->groupBy('product_id')
            ->map(function ($details, $productId) {
                return [
                    'product_name' => $details->first()->product->name,
                    'total_sold' => $details->sum('quantity')
                ];
            })->values();

        $today = Carbon::today();

        $totalTransactions = Transaction::where('created_at', $today)->count();

        $lastUpdated = Carbon::now()->translatedFormat('d M Y H:i');

        return view('pages.dashboard', compact('transactionData', 'productSales', 'totalTransactions', 'lastUpdated'));
    }
}
