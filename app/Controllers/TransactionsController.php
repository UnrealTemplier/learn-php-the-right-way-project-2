<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Transactions;
use App\View;

class TransactionsController
{
    public function index(): View
    {
        $transactions = new Transactions()->getAll();

        return View::make('transactions', ['transactions' => $transactions]);
    }
}