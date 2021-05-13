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
                <form name="promote" action="../app/promote.php" method="post">
                    <button type="submit" name="promote" value="<?=$row['id']?>" id="<?=$row['id']?>">Promote user to admin.</button>
                    <?php
                    $_SESSION['promoteId'] = $_POST['promote'];
                    ?>
                </form>
            </li>
        <?php
        endwhile;
    else: echo "<li>No results found</li>";
    endif; ?>
</ul>

