<?php
session_start();


$users = [
    'user1' => '12345',
    'user2' => '67890+'
];


if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    if (isset($_SESSION['logged_in'])) {
        $_SESSION['error_message'] = "User is already logged in, please log out first.";
        header("Location: login.php");
        exit;
    }

    
    if (isset($users[$username]) && $users[$username] === $password) {
        $_SESSION['logged_in'] = $username;
        $_SESSION['error_message'] = "Logged in successfully as $username.";
        header("Location: login.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Invalid username or password.";
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Please Log In</title>
</head>
<body>
    <h2>Login Page</h2>
    <form method="post" action="login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        <button type="submit" name="login">Login</button>
        <button type="submit" name="logout">Logout</button>
    </form>

    <p>
        <?php
        if (isset($_SESSION['error_message'])) {
            echo $_SESSION['error_message'];
            unset($_SESSION['error_message']); 
        }
        ?>
    </p>
</body>
</html>
