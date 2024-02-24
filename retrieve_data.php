<?php
$host = 'localhost';
$db   = 'agent_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Fetch transactions and summarize data
$transactionsSql = 'SELECT id,agent_id, date, credit, debit,Tomt,com_rate,balance, description,commission FROM transactions ORDER BY agent_id ASC, date ASC';
$stmt = $pdo->query($transactionsSql);
$transactions = $stmt->fetchAll();

// Prepare summary data
$summaryData = [];
foreach ($transactions as $transaction) {
    $agentId = $transaction['agent_id'];
    if (!isset($summaryData[$agentId])) {
        $summaryData[$agentId] = ['total_credit' => 0, 'total_debit' => 0, 'balance' => 0, 'total_commission' => 0];
    }
    $summaryData[$agentId]['total_credit'] += $transaction['credit'];
    $summaryData[$agentId]['total_debit'] += $transaction['debit'];
    $summaryData[$agentId]['total_commission'] += $transaction['commission'];

    // Calculate balance by subtracting debit from credit for each transaction, cumulatively
    $summaryData[$agentId]['balance'] += ($transaction['credit'] - $transaction['debit']);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Transactions List</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px; /* Adds space between tables */
        }
        table, th, td {
            border: 1px solid #ddd; /* Lighter border color */
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007bff; /* A strong, appealing blue */
            color: #ffffff; /* White text color for header */
            font-size: 16px;
        }
        td {
            font-size: 14px; /* Slightly smaller font size for data cells */
        }
        tbody tr:nth-child(odd) {
            background-color: #f2f2f2; /* Zebra striping for rows */
        }
        tbody tr:hover {
            background-color: #ddd; /* Hover effect for rows */
        }
    </style>
</head>
<body>

<h2>Transaction Records</h2>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            position: relative;
        }
        
        #search-form-container {
            position: absolute;
            top: 0;
            right: 0;
            margin: 20px;
        }
        
        form {
            padding: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        
        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px; /* Adjust based on your preference */
        }
        
        input[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .btn {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            margin-right: 5px;
        }

        .btn:hover {
            background-color: #45a049;
        }
         .edit-btn {
            background-color: #2196F3;
        }

        .edit-btn:hover {
            background-color: #0b7dda;
        }

        .delete-btn {
            background-color: #f44336;
        }

        .delete-btn:hover {
            background-color: #da190b;
        }
        .view-btn {
            background-color: #ff9800;
        }

        .view-btn:hover {
            background-color: #e68a00;
        }
    </style>
</head>
<body>

<div id="search-form-container">
    <form action="search.php" method="post">
        <input type="text" name="searchTerm" placeholder="Search Agent ID...">
        <input type="submit" name="search" value="Search">
    </form>
</div>

<br></br>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Agent ID</th>
            <th>Date</th>
            <th>Credit</th>
            <th>Debit</th>
            <!--<th>Tomt</th>
            <th>Com_rate</th>-->
            <th>Balance</th>
            <th>Description</th>
            <th>Commission</th>
            <th>Action</th>
            
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transactions as $transaction): ?>
        <tr>
            <td><?= htmlspecialchars($transaction['id']) ?></td>
            <td><?= htmlspecialchars($transaction['agent_id']) ?></td>
            <td><?= htmlspecialchars($transaction['date']) ?></td>
            <td><?= htmlspecialchars(number_format($transaction['credit'], 2)) ?></td>
            <td><?= htmlspecialchars(number_format($transaction['debit'], 2)) ?></td>
            <!--<td><?= htmlspecialchars($transaction['Tomt'], 2)?></td>
            <td><?= htmlspecialchars(number_format($transaction['com_rate'], 2)) ?></td>-->
            <td><?= htmlspecialchars(number_format($transaction['balance'], 2)) ?></td>
            <td><?= htmlspecialchars($transaction['description']) ?></td>
            <td><?= htmlspecialchars(number_format($transaction['commission'], 2)) ?></td>
            <td><a href="edit_record.php?id=<?= htmlspecialchars($transaction['id']) ?>"><button class="btn edit-btn">Edit</button></a> |<a href="delete_record.php?id=<?= htmlspecialchars($transaction['id']) ?>" onclick="return confirm('Are you sure you want to delete this record?');"><button class="btn delete-btn">Delete</button></a><button class="btn view-btn">View</button></td>

        </tr>
        <?php endforeach; ?>
    </tbody>
</table>



</body>
</html>
