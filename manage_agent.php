<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>manage Agent</title>

</head>
 <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f8f8;
            color: #333;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: #1e90ff;
        }

        a:hover {
            color: #0d47a1;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        .button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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

<body>
 <div class="container"> 
 <h1>DEESVENTURE CAPITAL LIMITED</h1>

    <?php
    // Database connection details (replace with your actual values)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dees";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Function to sanitize user input
    function sanitizeInput($data)
    {
        global $conn;
        return mysqli_real_escape_string($conn, trim($data));
    }

    // Edit record
    if (isset($_GET['edit'])) {
        $editId = sanitizeInput($_GET['edit']);
        $editQuery = "SELECT * FROM agent WHERE id = $editId";
        $editResult = $conn->query($editQuery);

        if ($editResult->num_rows > 0) {
            $editRow = $editResult->fetch_assoc();
            // Display the form with pre-filled values for editing
            include 'edit_form.php';
        }
    }

    // Update record
    if (isset($_POST['update'])) {
        $id = sanitizeInput($_POST['id']);
        $name = sanitizeInput($_POST['name']);
        $phone_no = sanitizeInput($_POST['phone_no']);

        $updateQuery = "UPDATE agent SET name = '$name', phone_no = '$phone_no' WHERE id = $id";
        $conn->query($updateQuery);
        header("Location: mydata.php"); // Redirect after update
    }

    // Delete record
    if (isset($_GET['delete'])) {
        $deleteId = sanitizeInput($_GET['delete']);
        $deleteQuery = "DELETE FROM agent WHERE id = $deleteId";
        $conn->query($deleteQuery);
        header("Location: mydata.php"); // Redirect after delete
    }

    // Fetch and display records
    $query = "SELECT * FROM agent";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Agent Name</th><th>Phone No</th><th>Action</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['phone_no'] . "</td>";
            echo "<td><a href='mydata.php?edit=" . $row['id'] . "' class='btn edit-btn'>Edit</a> | <a href='mydata.php?delete=" . $row['id'] . "' class='btn delete-btn' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a><button class='btn view-btn'>View</button></td>";

            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No records found</p>";
    }

    $conn->close();
    ?>
</div>
</body>

</html>
