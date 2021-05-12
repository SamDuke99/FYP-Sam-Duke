<?php
include("database/db.php");
include("includes/header.php");

$sql = "SELECT * FROM tblUser";
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
                <form name="promote" action="follow.php" method="post">
                    <button type="submit" name="follow" id="follow">Follow user.</button>
                    <?php
                    $_SESSION['followRequest'] = $row['id'];

                    ?>
                </form>
            </li>
        <?php
        endwhile;
    else: echo "<li>No results found</li>";
    endif; ?>


</ul>

