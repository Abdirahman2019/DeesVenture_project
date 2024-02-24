<!-- edit_form.php -->
<form method="post" action="manage_agent.php">
    <input type="hidden" name="id" value="<?php echo $editRow['id']; ?>">
    
    <div class="form-group">
        <label for="newName">Name:</label>
        <input type="text" name="name" value="<?php echo $editRow['name']; ?>" required>
    </div>

    <div class="form-group">
        <label for="newEmail">Phone:</label>
        <input type="text" name="phone_no" value="<?php echo $editRow['phone_no']; ?>" required>
    </div>

    <button type="submit" name="update" class="button">Update</button>
</form>

<style>
    form {
        max-width: 400px;
        margin: 20px auto;
        padding: 15px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    input {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button {
        display: inline-block;
        padding: 10px 15px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }
</style>

