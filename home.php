<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="stle.css">
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <a href="add.php">Add New User</a>
    <a href="logout.php">Logout</a>
    <h3>Filter Records</h3>
    <form method="GET" action="home.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age"><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender">
            <option value="">All</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="other">Other</option>
        </select><br>
        <button type="submit" name="filter">Filter</button>
    </form>
<div class="list">
    <h3>User List</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Surname</th>
            <th>Gender</th>
            <th>Date of Birth</th>
            <th>Actions</th>
        </tr>
</div>
</div>
        <?php
        $username = $_GET['username'] ?? '';
        $age = $_GET['age'] ?? '';
        $gender = $_GET['gender'] ?? '';

        // Calculate age from date of birth
        if ($age) {
            $age_condition = "YEAR(CURDATE()) - YEAR(dob) = '$age'";
        } else {
            $age_condition = "1";
        }

        // Build SQL query
        $sql = "SELECT * FROM users WHERE username LIKE '%$username%' AND $age_condition AND gender LIKE '%$gender%'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['firstname'] . "</td>";
            echo "<td>" . $row['surname'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['dob'] . "</td>";
            echo "<td>
                <a href='edit.php?id=" . $row['id'] . "'>Edit</a>
                <a href='delete.php?id=" . $row['id'] . "'>Delete</a>
                </td>";
            echo "</tr>";
        }
        ?>
    </table>
    <a href="pdf.php?username=<?php echo $username; ?>&age=<?php echo $age; ?>&gender=<?php echo $gender; ?>">Download PDF</a>
</body>
</html>
