<?php
include('config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];

    $sql = "UPDATE users SET username='$username', firstname='$firstname', surname='$surname', gender='$gender', dob='$dob' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "User updated successfully!";
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
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <h2>Edit User</h2>
    <form action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>" required><br>
        
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" value="<?php echo $row['firstname']; ?>" required><br>
        
        <label for="surname">Surname:</label>
        <input type="text" id="surname" name="surname" value="<?php echo $row['surname']; ?>" required><br>
        
        <label for="gender">Gender:</label>
        <select id="gender" name="gender">
            <option value="Male" <?php if ($row['gender'] == 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
        </select><br>
        
        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" value="<?php echo $row['dob']; ?>" required><br>
        
        <button type="submit" name="update">Update User</button>
    </form>
    </div>
    
</body>
</html>
