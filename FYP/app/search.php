<?php

include("database/db.php");
include("includes/header.php");


$sql = "SELECT * FROM tblUser WHERE username LIKE '%{$_POST['searchBar']}%'";
$result = $connect->query($sql);


?>

<html>
<head>
    <link rel="stylesheet" href="../assets/searchStyles.css">
</head>
<body>
<ul>
    <?php  if ($result->num_rows > 0) :
        while($row = $result->fetch_assoc()) :
        ?>
        <li>
            <?php echo $row['username']; ?>
            <form name="follow" action="../app/follow.php" method="post">
                <button type="submit" name="follow" value="<?=$row['id']?>" id="<?=$row['id']?>">Follow user.</button>

            </form>
        </li>
    <?php
        endwhile;
        else: echo "<li>No results found</li>";
    endif; ?>


</ul>
</body>
</html>

