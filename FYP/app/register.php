<?php
//session_start();

include("usersLogReg.php");

if (isset($_SESSION['error'])) {
    echo '<script type="text/javascript">alert("' . $_SESSION['error'] . '");</script>';
}
unset($_SESSION['error']);
?>
<html>
<head>
    <title>Register Page</title>
    <link rel="stylesheet" href="../assets/loginStyles.css">
</head>
<body>

<div id="frm3">
    <form action="register.php" method="POST">

        <input type="text" name="username" placeholder="Username">
        <br>
        <input type="text" name="email" placeholder="Email Address">
        <br>
        <input type="date" name="dateOfBirth" placeholder="DOB">
        <br>
        <input type="password" name="password" placeholder="Password">
        <br>
        <input type="password" name="pwdConf"  placeholder="Confirm Password">
        <br>

        <button type="submit" name="regBtn">Create Account</button>

    </form>
</div>

</body>
</html>
