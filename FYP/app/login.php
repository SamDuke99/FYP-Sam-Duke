<?php
session_start();

if (isset($_SESSION['error'])) {
    echo '<script type="text/javascript">alert("' . $_SESSION['error'] . '");</script>';
}
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>

    <link rel="stylesheet" href="../assets/loginStyles.css">
</head>
<body>

<div id="frm">
    <form action="usersLogReg.php" method="POST">


        <p>
            <label> Username: </label>
            <input type="text" id="username" name="username">
        </p>
        <p>
            <label> Password: </label>
            <input type="password" id="pwd" name="pwd">
        </p>
        <p>
            <button type="submit" name="logInBtn">Login</button>
        </p>
    </form>
    <form action="register.php" method="POST">
        <p>
            <button type="submit" name="btnNewAcc">Create New Account</button>
        </p>
    </form>
</div>
</body>
</html>
