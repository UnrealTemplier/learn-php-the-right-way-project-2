<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Transactions;
use App\View;
use Exception;

class HomeController
{
    public function index(): View
    {
        return View::make('index');
    }

    /**
     * @throws Exception
     */
    public function upload(): void
    {
        new Transactions()->store($_FILES['csv_files']);
    }
}
