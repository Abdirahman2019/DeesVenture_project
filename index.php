<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to your database here
    // $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }

    // Retrieve and sanitize input
    $agentName = htmlspecialchars($_POST['agentName']);
    $agentEmail = htmlspecialchars($_POST['agentEmail']);

    // Insert new agent into your database
    // $sql = "INSERT INTO agents (name, email) VALUES ('$agentName', '$agentEmail')";
    // if ($conn->query($sql) === TRUE) {
    //     echo "New agent registered successfully";
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }

    // Close connection
    // $conn->close();

    echo "New agent registered successfully"; // Placeholder response
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New Agent</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type=text], input[type=email] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type=submit] {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<form action="register.php" method="post">
    <h2>Register New Agent</h2>
    <input type="text" name="agentName" placeholder="Agent Name" required>
    <input type="email" name="agentEmail" placeholder="Agent Email" required>
    <input type="submit" value="Register">
</form>

</body>
</html>
