<?php
require_once '../test/Classes/User.php'; 


if (
    $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])
) {
    $user = new User();

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $user->loginUser($email, $password);

    if ($result) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['username'] = $user->getUsername();
        header("Location: index.php");
        exit();
    } else {
        echo "Login failed. Invalid email or password.";
    }
}

?>


<?php include('../test/Components/header.php'); ?>


<body>
    <h2>User Login</h2>
    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>

</html>