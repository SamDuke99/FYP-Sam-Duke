<?php
include("database/db.php");
include("includes/header.php");

if (isset($_SESSION['error'])) {
    echo '<script type="text/javascript">alert("' . $_SESSION['error'] . '");</script>';
}
unset($_SESSION['error']);
?>




<html>
<head>
    <title>Update your info</title>
    <link rel="stylesheet" href="../assets/loginStyles.css">
</head>
<body>

<div id="frm3">
    <form action="update.php" method="POST">


        <input type="text" name="email" placeholder="Email Address">
        <br>
        <input type="date" name="dateOfBirth" placeholder="DOB">
        <br>
        <input type="password" name="password" placeholder="Password">
        <br>

        <button type="submit" name="updateBtn">Edit account</button>

    </form>
</div>

</body>
</html>
