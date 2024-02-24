<?php
$host = 'localhost';
$db = 'agent_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $agent_id = $_POST['agent_id'];
    $date = $_POST['date'];
    $credit = $_POST['credit'] ?? 0;
    $debit = $_POST['debit'] ?? 0;
    $Tomt = $_POST['Tomt'] ?? 0;
    $com_rate = $_POST['com_rate'] ?? 0;
    $description = $_POST['description'];
    $commission = $_POST['commission'] ?? 0;

    $balanceQuery = "SELECT balance FROM transactions WHERE agent_id = ? ORDER BY date DESC, id DESC LIMIT 1";
    $stmt = $pdo->prepare($balanceQuery);
    $stmt->execute([$agent_id]);
    $lastBalance = $stmt->fetchColumn();
    $newBalance = $lastBalance + $credit - $debit;

    $sql = "INSERT INTO transactions (agent_id, date, credit, debit, Tomt, com_rate, balance, description, commission) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$agent_id, $date, $credit, $debit, $Tomt, $com_rate, $newBalance, $description, $commission]);

    echo "<div class='success-message'>Transaction recorded successfully.</div>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Record a Transaction</title>
    <!--<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>-->
    <script src="jquery.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }
        h2 {
            color: #333;
        }
        input[type=number], input[type=date], input[type=text],textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type=submit] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #0056b3;
        }
        .success-message {
            color: #28a745;
            background-color: #dff0d8;
            border-color: #d4edda;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        select {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}
    </style>
</head>
<body>

<div class="form-container">
    <h2>Transaction Form</h2>

    <form method="post">
        <label for="agent_id">Agent ID:</label>
        <input type="number" id="agent_id" name="agent_id" required><br>
        
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br>
        
        <label for="credit">Amount_Deposit:</label>
        <input type="number" id="credit" step="0.01" name="credit"><br>
        
        <label for="debit">cashed_out:</label>
        <input type="number" id="debit" step="0.01" name="debit" onchange="calculateCommission()"><br>

        <label for="Type_of_Money_Transfer">Type_of_Money_Transfer:</label>
        <select id="Tomt" name="Tomt" >
             <?php
        // Connect to your database (replace these values with your actual database credentials)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dees";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch agents from the database
        $sql = "SELECT id, name FROM transaction_type";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
            }
        }

        $conn->close();
        ?>
    </select>
        <label for="com_cate">Com_Rate:</label>
        <select id="com_rate" name="com_rate" onchange="calculateCommission()" ></select>
        <script>
        $(document).ready(function () {
            $('#Tomt').change(function () {
                var transaction_typeid = $(this).val();

                // Send AJAX request to get customers based on the selected agent
                $.ajax({
                    url: 'get_dependency.php',
                    type: 'post',
                    data: {transaction_type_id: transaction_typeid},
                    dataType: 'json',
                    success: function (response) {
                        var options = '<option value="">Select Com_Rate</option>';
                        $.each(response, function (key, value) {
                            options += '<option value="' + value.per_rate + '">' + value.per_rate + '</option>';
                        });
                        $('#com_rate').html(options);
                    }
                });
            });
        });
    </script>
        <br><label for="description">Description:</label><br>
        <textarea id="description" name="description"></textarea><br>
        <label for="commission">Commission gain: </label><br>
        <input type="text" id= "commission" name="commission" readonly><br>
        <input type="submit" value="Submit">
    </form>
    <script>
    function calculateCommission() {
        var debit = parseFloat(document.getElementById('debit').value);
        var com_rate = parseFloat(document.getElementById('com_rate').value);
        var commission = debit * com_rate;
        
        // Display the commission in the commission text field
        document.getElementById('commission').value = commission.toFixed(2);
    }
</script>
</div>

</body>
</html>
