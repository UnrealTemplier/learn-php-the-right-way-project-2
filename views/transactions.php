<!DOCTYPE html>
<html lang="en">
<head>
    <title>Transactions</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        table tr th, table tr td {
            padding: 5px;
            border: 1px #eee solid;
        }

        tfoot tr th, tfoot tr td {
            font-size: 20px;
        }

        tfoot tr th {
            text-align: right;
        }
    </style>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>Date</th>
        <th>Check #</th>
        <th>Description</th>
        <th>Amount</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->transactions as $transaction): ?>
    <tr>
        <td><?= $transaction['date'] ?></td>
        <td><?= $transaction['check_number'] ?></td>
        <td><?= $transaction['description'] ?></td>
        <td style="color: <?= $transaction['color'] ?>"><?= $transaction['amount'] ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
    <tr>
        <th colspan="3">Total Income:</th>
        <td><?= $this->income ?></td>
    </tr>
    <tr>
        <th colspan="3">Total Expense:</th>
        <td><?= $this->expense ?></td>
    </tr>
    <tr>
        <th colspan="3">Net Total:</th>
        <td><?= $this->net ?></td>
    </tr>
    </tfoot>
</table>
</body>
</html>
