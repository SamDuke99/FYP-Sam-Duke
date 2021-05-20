<?php

include("database/db.php");
include("includes/header.php");
include("../mainPage.php");




?>

<html>
<head>
    <link rel="stylesheet" href="../assets/searchStyles.css">
</head>
<body>
<ul>
    <h2>Users:</h2>
    <?php
    $sql = "SELECT * FROM tblUser WHERE username LIKE '%{$_POST['searchBar']}%'";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) :
        while($row = $result->fetch_assoc()) :
            ?>
            <li>
                <?php echo "<p>" . $row['username'] . "</p>"; ?>
                <form name="follow" action="../app/follow.php" method="post">
                    <button type="submit" name="follow" value="<?=$row['id']?>" id="<?=$row['id']?>">Follow user.</button>
                </form>
            </li>
            <br>
        <?php
        endwhile;
    else: echo "<li>No results found</li>";
    endif; ?>

    <h2>Posts:</h2>

    <?php
    $sql = "SELECT * FROM tblPosts WHERE post_title LIKE '%{$_POST['searchBar']}%'";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rowId = $row['id'];
            echo "<div class=\"mainPost\">";
            echo "<div class=\"post\"> <h2> Username: " . $row["user_name"] . "</h2></div>";
            echo "<div class=\"post\"> <h3> " . $row["post_title"] . "</h3></div>";
            echo "<div class=\"post\"> <p> &nbsp;  " . $row["post_subject"] . "</p></div>";
            echo "<div class=\"postCont\"> <p>" . $row["post_contents"] . "</p></div>";
            echo "<div class=\"post\"> <p> &nbsp;  " . $row["post_date"] . "</p></div>";
            echo "<br>";

            echo "<div class=\"comment\"> <p> &nbsp;  Comments: </p></div>";
            //comments
            $cSql = "SELECT * FROM tblComments WHERE post_id= '$rowId' ORDER BY comment_date DESC";
            $cResult = $connect->query($cSql);

            if ($cResult->num_rows > 0) {
                while($cRow = $cResult->fetch_assoc()) {
                    echo "<div class= \"comment\">";
                    echo "<div class=\"commentCont\"> <p> &nbsp;  " . $cRow['comment_contents'] . "</p></div>";
                    echo "<div class=\"commentUser\"> <p> &nbsp;  Posted by: " . $cRow['user_name'] . "</p></div>";
                    echo "<div class=\"commentTime\"> <p> &nbsp;   " . $cRow['comment_date'] . "</p></div>";
                    echo "</div>";
                    echo "<br>";
                }
            }

            ?>
            <form name="writeForm" action="comment.php" method="post">
                <p>Write a comment:</p>
                <p> <textarea name="userComment" id="userComment" placeholder="Type here..." rows="6" cols="101"></textarea></p>
                <button type="submit" name="commentBtn" value="<?=$row['id']?>" id="<?=$row['id']?>">Comment</button>
            </form>
            </div>
            <br><br>
            <?php
        }
    } else echo "<li>No results found</li>";
    ?>


</ul>
</body>
</html>

