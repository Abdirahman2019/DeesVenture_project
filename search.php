<?php
if (isset($_POST['search'])) {
    $searchTerm = $_POST['searchTerm'];

    // Create connection
    $conn = new mysqli("localhost", "root", "", "agent_db");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM transactions WHERE agent_id LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$searchTerm%";
    $stmt->bind_param("s", $searchTerm);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
    echo '<div class="search-results">';
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<div class="result-item">';
        echo "id: " . $row["id"]. " - agent_id: " . $row["agent_id"].  " - credit: " . $row["credit"]. " -debit: ".$row['debit'];
        echo '</div>';
    }
    echo '</div>';
} else {
    echo '<div class="no-results">0 results</div>';
}
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
    
?>
<style>
.search-results {
    margin: 20px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
}

.result-item {
    margin: 10px 0;
    padding: 10px;
    border-bottom: 1px solid #eee;
    font-family: Arial, sans-serif;
}

.result-item:last-child {
    border-bottom: none;
}

.no-results {
    color: #999;
    margin: 20px;
    padding: 10px;
    font-family: Arial, sans-serif;
}
</style>


