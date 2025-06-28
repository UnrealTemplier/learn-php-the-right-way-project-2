<?php

namespace App\Models;

use App\Model;
use DateTimeImmutable;
use Exception;

class Transactions extends Model
{
    /**
     * @throws Exception
     */
    public function store(array $uploadedFiles): void
    {
        $allowedTypes = ['text/csv', 'application/vnd.ms-excel'];

        foreach ($uploadedFiles['tmp_name'] as $index => $tmpName) {
            if (!in_array($uploadedFiles['type'][$index], $allowedTypes)) {
                throw new Exception('Invalid file format');
            }

            $file = fopen($tmpName, 'r');

            fgetcsv($file, escape: '');

            $stmt = $this->db->prepare(
                'INSERT INTO transactions (date, check_number, description, amount)
                 VALUES (:date, :check_number, :description, :amount)',
            );

            while ($data = fgetcsv($file, escape: '')) {
                $date = DateTimeImmutable::createFromFormat('m/d/Y', $data[0]);
                $checkNumber = $data[1] ?? null;
                $description = $data[2];
                $amount = str_replace(['$', ','], '', $data[3]);

                $stmt->bindValue(':date', $date->format('Y-m-d'));
                $stmt->bindValue(':check_number', $checkNumber);
                $stmt->bindValue(':description', $description);
                $stmt->bindValue(':amount', $amount);

                $stmt->execute();
            }

            fclose($file);
        }
    }
}