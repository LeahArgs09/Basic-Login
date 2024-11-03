<?php
session_start(); 
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $age = (int)$_POST['age']; 
    $course = $_POST['course'];
    $year = $_POST['year'];
    $user_type = $_POST['user_type'];

    $_SESSION['firstname'] = $firstname;
    $_SESSION['lastname'] = $lastname;
    $_SESSION['age'] = $age;
    $_SESSION['course'] = $course;
    $_SESSION['year'] = $year;
    $_SESSION['user_type'] = $user_type;

    header("Location: Register2.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="..//styles/register1.css">
</head>
<body>

<div class="form-container">
    <h2>Registration Form [1/2]</h2> 
    <form action="register2.php" method="post">
        <div class="form-group">
            <input type="text" id="firstname" name="firstname" placeholder="Firstname" required>
            <input type="text" id="lastname" name="lastname" placeholder="Lastname" required>
            <input type="number" id="age" name="age" placeholder="Age" required min="1">
        </div>
        
        <div class="form-group-course">
            <label for="course">Course:</label>
            <select id="course" name="course" required>
                <option value="">Select...</option>
                <option value="nursing">Bachelor of Science in Nursing</option>
                <option value="medtech">Bachelor of Science in Medical Technology</option>
                <option value="pharma">Bachelor of Science in Pharmacy</option>
                <option value="IT">Bachelor of Science in Information Technology</option>
                <option value="BA">Bachelor of Science in Business Administration</option>
                <option value="Psych">Bachelor of Science in Psychology</option>
                <option value="Educ">Bachelor of Science in Elementary Education</option>
                <option value="Theo">Bachelor of Arts in Theology</option>
                <option value="med">School of Medicine</option>
                <option value="BED">Basic Education</option>
            </select>
        </div>

        <div class="form-group-year">
            <label for="year">Year Level:</label>
            <select id="year" name="year" required>
                <option value="">Select...</option>
                <option value="first">First Year</option>
                <option value="second">Second Year</option>
                <option value="third">Third Year</option>
                <option value="fourth">Fourth Year</option>
            </select>
        </div>

        <div class="form-group">
            <label for="user-type">User Type:</label>
            <select id="user-type" name="user_type" required>
                <option value="student">Student</option>
                <option value="facilitator">Facilitators</option>
                <option value="admin">Administrators</option>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="button">Register</button>
        </div>
    </form>
</div>

</body>
</html>
