<!DOCTYPE html>
<html>
<head>
    <title>Deesventure</title>
</head>
<body>
<?php
// Redirect the user to login.php
header('Location: login.php');
exit; // Always call exit after a header redirect to stop execution of the current script
?>
</body>
</html>