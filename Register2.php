<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['firstname'], $_SESSION['lastname'], $_SESSION['age'], $_SESSION['course'], $_SESSION['year'], $_SESSION['user_type'])) { 
        die("Error: Missing session data.");
    }
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $age = $_SESSION['age'];
    $course = $_SESSION['course'];
    $year = $_SESSION['year'];
    $user_type = $_SESSION['user_type'];

    $username = htmlspecialchars(trim($_POST['username'])); 
    $password = htmlspecialchars(trim($_POST['password'])); 
    $confirm_password = htmlspecialchars(trim($_POST['confirm_password'])); 


    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match. Please try again.";
    } else {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO userInfo (firstname, lastname, age, course, year, user_type, username, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ssisssss", $firstname, $lastname, $age, $course, $year, $user_type, $username, $hashed_password);

        if ($stmt->execute()) {
            $success_message = "Registration successful! You can now log in.";
            session_unset();
            session_destroy();
            header("Location: login.php");
            exit();

        } else {
            $error_message = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Credentials</title>
    <link rel="stylesheet" href="..//styles/register2.css">
</head>
<body>

<div class="form-container-reg">
    <h2>Register Credentials</h2>
    <form action="register.php" method="post">
        <input type="text" id="username" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Submit</button>
    </form>

    <?php if (isset($error_message)): ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <?php if (isset($success_message)): ?>
        <div class="success-message"><?php echo $success_message; ?></div>
    <?php endif; ?>
</div>

</body>
</html>
