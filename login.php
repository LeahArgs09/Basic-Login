<?php   
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query the database to retrieve the user's password
    $sql = "SELECT password FROM userInfo WHERE username = ?"; // the userInfo is the name of yor sql table
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Check if the user exists and the password is correct
    if ($row && password_verify($password, $row["password"])) {
        header ("Location: home.php");
        // Implement authentication and authorization logic here
    } else {
        header ("Location: home.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <title>BC Intramurals Tabulation</title>
    <link rel="stylesheet" href="..//styles/login.css">
</head>
<body>

<div class="container" id="container">
    <div class="form-container">
        <form action="login.php" method="POST"> 
            <h1>Log In Form</h1>
            <input type="username" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <span>or register here</span>
            <a href="registration.php" class="button">Register</a>
        </form>

        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
