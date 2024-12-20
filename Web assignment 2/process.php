<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $phone = $conn->real_escape_string(trim($_POST['phone']));
    $gender = $conn->real_escape_string(trim($_POST['gender']));
    $password = $conn->real_escape_string(trim($_POST['password']));
    $dob = $conn->real_escape_string(trim($_POST['dob']));

    if (empty($name) || empty($email) || empty($phone) || empty($gender) || empty($password) || empty($dob)) {
        die("All fields are required.");
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, phone, gender, password, dob) VALUES ('$name', '$email', '$phone', '$gender', '$hashedPassword', '$dob')";

    if ($conn->query($sql) === TRUE) {

        echo "Inserted details:\n\n";
        echo "Name: $name\n\n";
        echo "Email: $email\n\n";
        echo "Phone: $phone\n\n";
        echo "Gender: $gender\n\n";
        echo "Date of Birth: $dob\n\n";
    } else {
        echo "Error: " . $sql . "\n" . $conn->error;
    }
}

$conn->close();