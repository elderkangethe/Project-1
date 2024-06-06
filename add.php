<?php
include('config.php');

if (isset($_POST['add'])) {
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];

    $sql = "INSERT INTO users (username, firstname, surname, password, gender, dob) VALUES ('$username', '$firstname', '$surname', '$password', '$gender', '$dob')";
    if (mysqli_query($conn, $sql)) {
        echo "User added successfully!";
        header('Location: home.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <h2>Add New User</h2>
    <form action="add.php" method="POST">
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
            <option value="Other">Other</option>
        </select><br>
        
        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required><br>
        
        <button type="submit" name="add">Add User</button>
    </div>
    </form>
</body>
</html>
