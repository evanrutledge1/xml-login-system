<?php
ob_start();
session_start();
if(!file_exists('users/' . $_SESSION['username'] . '.xml')){
    header('Location: login.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>User page</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>User page</h1>
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
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
        <h2>Phonebook</h2>
        <table>
            <tr>
                <th>Username</th>
                <th>Email</th>
            </tr>
            <?php
                $files = glob('users/*xml');
                foreach($files as $file) {
                    $xml = new SimpleXMLElement ($file, 0, true);
                    echo '
                    <tr>
                        <td>'. basename($file, '.xml') .'</td>
                        <td>'. $xml->email .'</td>
                    </tr>
                    ';
                }
            ?>
    </table>
    <hr />
    <a href="uploadvideo.php">Upload video</a>
    <a href="changepassword.php">Change password</a>
    <a href="logout.php">Logout</a>
</body>
</html>