<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Transactions;
use App\View;
use DateTimeImmutable;

class TransactionsController
{
    public function index(): View
    {
        $transactions = new Transactions()->getAll();

        $transactions = array_map(function (array $transaction) {
            $transaction['date'] = $this->formatDate($transaction['date']);
            $transaction['amount'] = $this->formatAmount($transaction['amount']);
            return $transaction;
        }, $transactions);

        return View::make('transactions', ['transactions' => $transactions]);
    }

    protected function formatDate(string $date): string
    {
        $date = DateTimeImmutable::createFromFormat('Y-m-d', $date);
        $year = $date->format('Y');
        $month = $date->format('M');
        $day = ltrim($date->format('d'), '0');
        return "$month $day, $year";
    }

    protected function formatAmount(string $amount): string
    {
        $isNegative = $amount[0] === '-';
        $amount = number_format(floatval($amount), 2);
        return $isNegative ? '-$' . substr($amount, 1) : '$' . $amount;
    }
}