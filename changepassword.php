<?php
ob_start();
session_start();
if(!file_exists('users/' . $_SESSION['username'] . '.xml')){
    header('Location: login.php');
}
$error = false;
if(isset($_POST['change'])){
    $old = md5 ($_POST['o_password']);
    $new = md5 ($_POST['n_password']);
    $c_new = md5($_POST['c_n_password']);
    
    $xml = new SimpleXMLElement ('users/' . $_SESSION['username'] . '.xml', 0, true);
    if($old == $xml->password){
        if($new == $c_new){
            $xml->password = $new;
            $xml->asXML('users/' . $_SESSION['username'] . '.xml');
            header('Location: logout.php');
        }
    }
    $error = true;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Change password</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Change password</h1>
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
        <?php
        if($error){
            echo '<p>Some of the passwords do not match</p>';
        }
        ?>
        <p>Old password <input type="password" name="o_password" /></p>
        <p>New password <input type="password" name="n_password" /></p>
        <p>Confirm new password <input type="password" name="c_n_password" /></p>
        <p><input type="submit" name="change" value="Change password" /></p>
    </form>
    
    <hr />
    <a href="index.php">User home</a>
</body>
</html>