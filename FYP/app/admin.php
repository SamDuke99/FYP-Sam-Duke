<?php
include("database/db.php");
include("includes/header.php");

$sql = "SELECT * FROM tblUser ORDER BY username";
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
                <?php echo "<p>" . $row['username'] . "</p>"; ?>
                <form name="promote" action="../app/promote.php" method="post">
                    <button type="submit" name="promote" value="<?=$row['id']?>" id="<?=$row['id']?>" onclick="return confirm('Are you sure?')">Promote user to admin</button>
                </form>
                <form name="delete" action="../app/delete.php" method="post">
                    <button type="submit" name="delete" value="<?=$row['id']?>" id="<?=$row['id']?>" onclick="return confirm('Are you sure?')">Delete user account</button>
                </form>
                <form name="adminView" action="../app/adminView.php" method="post">
                    <button type="submit" name="viewMess" value="<?=$row['id']?>" id="<?=$row['id']?>">View user messages</button>
                </form>
            </li>
        <?php
        endwhile;
    else: echo "<li>No results found</li>";
    endif; ?>
</ul>

