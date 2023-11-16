<?php
require_once '../test/Classes/User.php';  // Include the User class file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User();

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $user->registerUser($username, $email, $password);

    if ($result) {
        echo "Registration successful. You can now <a href='login.php'>login</a>.";
    } else {
        echo "Registration failed.";
    }
}



?>
<!DOCTYPE html>
<html lang="en">


<?php include('../test/Components/header.php'); ?>


<body>
    <h2>User Registration</h2>
    <form action="index.php" method="post">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Register</button>
    </form>
</body>

</html>