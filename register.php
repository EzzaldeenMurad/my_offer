<?php
include 'conn_db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $stmt = $conn->prepare("INSERT INTO `user`(`first_name`, `last_name`, `email`, `password`, `address`, `phone`, `creation_date`) VALUES (?, ?, ?, ?, ?, ?, NOW())");

    $stmt->bind_param("ssssss", $firstName, $lastName, $email, $password, $address, $phone);
    $stmt->execute();
    if (!$stmt) {
        echo "<script>alert('Registration successful.');
          window.location.href = 'index.php';
          </script>";
    } else {
        echo "<script> alert('Registration successful.'); </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form.css">
    <title>Promoter Registration</title>
</head>

<body>
    <div class="container">
        <h2>Promoter Registration</h2>
        <form action="register.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" name="firstName" id="firstName" placeholder="First Name here.." required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" name="lastName" id="lastName" placeholder="Last Name here.." required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Email here.." required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Password here.." required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" placeholder="Address here.." required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" name="phone" id="phone" placeholder="Phone here.." required>
            </div>
            <div class="form-group">
                <input type="submit" value="Register">
            </div>
        </form>
    </div>
</body>

</html>