<?php
$conn = new mysqli("localhost", "root", "", "student_project");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$dob = $_POST['dob'];
$dept = $_POST['department'];
$phone = $_POST['phone'];

$sql = "INSERT INTO students (name, email, dob, department, phone)
        VALUES ('$name', '$email', '$dob', '$dept', '$phone')";

if ($conn->query($sql) === TRUE) {
    header("Location: view.php");
    exit();
} else {
    echo "❌ Error: " . $conn->error;
}

$conn->close();
?>
