<?php
//session_start();

include("usersLogReg.php");


?>

<html>
<head>
    <title>Register Page</title>
    <link rel="stylesheet" href="../assets/loginStyles.css">
</head>
<body>

<div id="frm3">
    <form action="register.php" method="POST">

       <?php //TODO proper error handling and notifications here?>
        <?php if(count($errors) > 0): ?>
        <?php foreach ($errors as $error): ?>
            <div class="error">
                <li><?php echo $error ?></li>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>



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
