<?php
$error = false;
if(isset($_POST['login'])){
    $username = preg_replace('/[^A-Za-z]/', '', $_POST['username']);
    $password = md5($_POST['password']);
    if(file_exists('users/' . $username . '.xml')){
        $xml = new SimpleXMLElement('users/' . $username . '.xml', 0, true);
        if($password == $xml->password) {
            session_start();
            $_SESSION['username'] = $username;
                header('Location: index.php');
                die;
        }
    }
    $error = true;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Login</h1>
    <ul>
        <li><a href="../index.php">Home</a></li>
        <li><a href="../browse.php">Browse</a></li>
        <li><a href="../about.php">About</a></li>
        <?php
            if(file_exists('users/' . $_SESSION['username'] . '.xml')){
                echo "<li><a href='../account/'>{$_SESSION['username']}</a><li>";
            } else {
                echo "<li><a href='login.php'>Login or Register</a></li>";
            }
        ?>
    </ul>
    <form method="post" action="">
        <p>Username <input type="text" name="username" size="20" /></p>
        <p>Password <input type="password" name="password" size="20" /></p>
        <?php
        if($error) {
            echo '<p>Invalid username or password</p>';
        }
        ?>
        <p><input type="submit" value="Login" name="login" /></p>
    </form>
    <a href="register.php">Register</a>
</body>
</html>