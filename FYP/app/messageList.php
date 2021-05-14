<?php
include("database/db.php");
include("includes/header.php");

//$conditions = ['receiver_id' => $_SESSION['id']];

//selectAll('tblMessages', $conditions)
$user = $_SESSION['id'];
$sql = "SELECT * FROM tblFollowers WHERE follower_id='$user'";
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
                <?php
                $data = ['id' => $row['user_id']];
                   $userGot = selectOne('tblUser', $data);
                echo $userGot['username']; ?>
                <form name="message" action="viewMessage.php" method="post">
                    <button type="submit" name="viewMess" value="<?=$row['user_id']?>" id="<?=$row['user_id']?>">Message</button>
                </form>
            </li>
        <?php
        endwhile;
    else: echo "<li>No results found</li>";
    endif; ?>
</ul>

