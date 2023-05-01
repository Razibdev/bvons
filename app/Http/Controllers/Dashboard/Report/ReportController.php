<?php

namespace App\Http\Controllers\Dashboard\Report;

use App\Http\Controllers\Controller;
use App\Model\Transaction\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    public function index()
    {
        $transaction_report = [
            "creditList" => Transaction::credit()->orderBy('created_at', 'desc')->paginate(20),
            "debitList" => Transaction::debit()->orderBy('created_at', 'desc')->paginate(20),
            "totalIncome" => Transaction::creditSum(),
            "totalPaid" => Transaction::debitSum(),
            "totalDue" => (Transaction::creditSum() - Transaction::debitSum()),
        ];

        return view('dashboard.report.index', compact('transaction_report'));
    }
}
