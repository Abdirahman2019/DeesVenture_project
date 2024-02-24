<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Agents</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        ul li {
            margin: 10px 0;
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        ul li a {
            text-decoration: none;
            color: #007bff;
            display: block;
        }
        ul li a:hover {
            background-color: #e9ecef;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h2>LIST OF AGENTS</h2>
    <ul>
        <?php
        // Connect to the database (you need to fill in the database credentials)
        $conn = new mysqli("localhost", "root", "", "dees");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch and display customers
        $sql = "SELECT id, name FROM agent";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<li><a href='submit_transaction.php?id=" . htmlspecialchars($row["id"]) . "'>" . htmlspecialchars($row["name"]) . "</a></li>";
            }
        } else {
            echo "<li>No Agent found.</li>";
        }

        $conn->close();
        ?>
    </ul>
</body>
</html>
