<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <h2>Register</h2>
    <form action="register.php" method="POST" class="form">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" required><br>
        
        <label for="surname">Surname:</label>
        <input type="text" id="surname" name="surname" required><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        
        <label for="gender">Gender:</label>
        <select id="gender" name="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Others">Others</option>
        </select><br>
        
        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required><br>
        
        <button type="submit" name="register">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>

<?php
// Include database configuration
include('config.php');

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];

    $sql = "INSERT INTO users (username, firstname, surname, password, gender, dob) VALUES ('$username', '$firstname', '$surname', '$password', '$gender', '$dob')";
    if (mysqli_query($conn, $sql)) {
        echo "Registration successful!";
        header('Location: login.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
