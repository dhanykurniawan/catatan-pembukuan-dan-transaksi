<?php

namespace App\Http\Controllers;

use App\Models\Master;
use Illuminate\Http\Request;
use App\Models\Transaction;

class ReportController extends Controller
{
    public function report()
    {
        $transactions = Transaction::get();

        return view('report', [
            'transactions' => $transactions,
        ]);
    }
}
