<?php
// Connect to database
$host = 'localhost'; // or your host
$username = 'root';
$password = '';
$dbname = 'Deesventrure_db';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $agentName = $_POST['agentName'];
    $agentEmail = $_POST['agentEmail'];
    // Further validation can be added here (e.g., sanitize input)

    $sql = "INSERT INTO agents (name, email) VALUES (?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $agentName, $agentEmail);

    if ($stmt->execute()) {
        echo "New agent registered successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register New Agent</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 600px; margin: auto; padding: 20px; }
        form { display: flex; flex-direction: column; }
        label { margin-bottom: 5px; }
        input[type=text], input[type=email] { margin-bottom: 20px; padding: 10px; }
        input[type=submit] { padding: 10px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        input[type=submit]:hover { background-color: #45a049; }
    </style>
</head>
<body>

<div class="container">
    <h2>Register New Agent</h2>
    <form method="POST" action="registerAgent.php">
        <label for="agentName">Name:</label>
        <input type="text" id="agentName" name="agentName" required>

        <label for="agentEmail">Email:</label>
        <input type="email" id="agentEmail" name="agentEmail" required>

        <input type="submit" value="Register">
    </form>
</div>

</body>
</html>