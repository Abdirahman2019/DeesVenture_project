<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEESVENTURE CAPITAL LIMITED</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        h2 {
            color: #666;
            margin-bottom: 10px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
        /* Heading Styles */
h2 {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* A clean, modern font */
    color: #2c3e50; /* Dark shade for contrast */
    margin: 10px 0; /* Adds some space around each heading */
}

h2 a {
    text-decoration: none; /* Removes the underline from links */
    color: #2980b9; /* A pleasing shade of blue */
    transition: color 0.3s ease; /* Smooth transition for hover effect */
}

h2 a:hover {
    color: #3498db; /* Lighter blue for hover state */
    text-decoration: underline; /* Adds underline on hover for emphasis */
}

/* Optional: Adjust the size of the h2 for better visual hierarchy */
h2 {
    font-size: 22px; /* Slightly larger font size for headings */
}

/* Additional Style: Adding some padding to increase clickable area and improve accessibility */
h2 a {
    display: inline-block; /* Allows padding to affect the link */
    padding: 5px 10px; /* Adds padding around the text */
    border-radius: 5px; /* Optional: Adds rounded corners for a softer look */
    background-color: #f4f4f4; /* Light background color for the link */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Adds subtle shadow for depth */
}

h2 a:hover {
    background-color: #e0e0e0; /* Slightly darker background on hover */
}

    </style>
</head>

<body>
    <h1>DEESVENTURE CAPITAL LIMITED</h1>
    <!--<h2><a href="list_agent.php">List Of Agent</a></h2>
    <h2><a href="mydata.php">update  Agent</a></h2>
    <h2><a href="retrieve_data.php">Daily_transaction_of_agent</a></h2>
    <h2><a href="index3.php">Register New Agent</a></h2>-->
    <form action="add_customer.php" method="post">
        <h2>Add New Agent</h2>
        <label for="ID">Agent ID:</label>
        <input type="text" name="id" required>
        <label for="name">Agent Name: </label>
        <input type="text" name="name" required>
        <label for="name">Phone No: </label>
        <input type="text" name="phone_no" required>

        <input type="submit" value="Add Agent">
    </form>
</body>

</html>
