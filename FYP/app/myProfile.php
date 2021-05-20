<?php
include("database/db.php");
include("includes/header.php");

$id = $_SESSION['id'];

?>

<html>
<body>

<?php


$user = $_SESSION['id'];

$sql = "SELECT * FROM tblUser WHERE id= '$user'";
$result = $connect->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class=\"infoSec\">";
        echo "<div class=\"info\"> <h2> &nbsp;  Username: " . $row["username"] . "</h2></div>";
        echo "<div class=\"info\"> <h2> &nbsp;  Email: " . $row["email"] . "</h2></div>";
        echo "<div class=\"info\"> <h2> &nbsp;  Date of birth: " . $row["dateOfBirth"] . "</h2></div>";
        echo "</div>";
        echo "<br>";
        ?>
        <div class="info">
        <form name="editForm" action="edit.php" method="post">
            <button type="submit" name="editBtn" value="<?=$row['id']?>" id="<?=$row['id']?>">Edit</button>
        </form>
        </div>
        <form name="delete" action="../app/delete.php" method="post">
            <button type="submit" name="delete" value="<?=$row['id']?>" id="<?=$row['id']?>" onclick="return confirm('Are you sure?')">Delete user account</button>
        </form>
        <?php
    }
}

$sql = "SELECT * FROM tblPosts WHERE user_id= '$user' ORDER BY post_date DESC";
$result = $connect->query($sql);
echo "<div class=\"post\"> <h2> My posts:</h2></div>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $rowId = $row['id'];
        echo "<div class=\"mainPost\">";
        echo "<div class=\"post\"> <h2> &nbsp;  Username: " . $row["user_name"] . "</h2></div>";
        echo "<div class=\"post\"> <h3> &nbsp;  " . $row["post_title"] . "</h3></div>";
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


</body>
</html>
