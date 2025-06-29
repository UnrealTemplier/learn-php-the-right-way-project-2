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

        $income = 0;
        $expense = 0;

        $transactions = array_map(function (array $transaction) use (&$income, &$expense) {
            $transaction['date'] = $this->formatDate($transaction['date']);

            $amount = $transaction['amount'];

            $transaction['color'] = $this->getAmountColor($amount);
            $transaction['amount'] = $this->formatMoney($amount);

            $amountNumber = floatval($amount);
            if ($amountNumber > 0) {
                $income += $amountNumber;
            } else {
                $expense += $amountNumber;
            }

            return $transaction;
        }, $transactions);

        return View::make(
            'transactions',
            [
                'transactions' => $transactions,
                'income'  => $this->formatMoney(strval($income)),
                'expense' => $this->formatMoney(strval($expense)),
                'net'     => $this->formatMoney(strval($income + $expense)),
            ],
        );
    }

    protected function formatDate(string $date): string
    {
        $date = DateTimeImmutable::createFromFormat('Y-m-d', $date);
        $year = $date->format('Y');
        $month = $date->format('M');
        $day = ltrim($date->format('d'), '0');
        return "$month $day, $year";
    }

    protected function formatMoney(string $amount): string
    {
        $isNegative = $amount[0] === '-';
        $amount = number_format(floatval($amount), 2);
        return $isNegative ? '-$' . substr($amount, 1) : '$' . $amount;
    }

    protected function getAmountColor(string $amount): string
    {
        return $amount[0] === '-' ? 'red' : 'green';
    }
}