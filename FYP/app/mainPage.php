<?php
include("database/db.php");
include("includes/header.php");

function writePost($row) {
    //main post
    echo "<div class=\"mainPost\">";
    echo "<div class=\"post\"> <h2> Username: " . $row["user_name"] . "</h2></div>";
    echo "<div class=\"post\"> <p> &nbsp;  " . $row["post_subject"] . "</p></div>";
    echo "<div class=\"postCont\"> <p>" . $row["post_contents"] . "</p></div>";
    echo "<div class=\"post\"> <p> &nbsp;  " . $row["post_date"] . "</p></div>";

    echo "<br>";
}

function writeComment($cResult) {
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
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/mainStyles.css">
</head>
<body>

<div class="row">
    <div class="leftcolumn">
        <div class="posts">
            <div class="writePost">
                <form name="writeForm" action="post.php" method="post">
                    <p>Write a post:</p>
                    <label for="subject">Choose a subject:</label>
                    <select name="subject" id="subject">
                        <optgroup label="Subjects">
                            <option value="CompSci">CompSci</option>
                            <option value="Economics">Economics</option>
                            <option value="Maths">Maths</option>
                            <option value="Music">Music</option>
                            <option value="English">English</option>
                        </optgroup>
                    </select>
                    <p> <textarea name="userPost" id="userPost" placeholder="Type here..." rows="6" cols="128"></textarea></p>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p><input type="submit" name="postBtn" value="Post"></p>
                </form>
            </div>
        </div>
        <div class="post">
            <form name="writeForm" method="post">
                <label for="subjectView">Choose a subject:</label>
                <select name="subjectView" id="subjectView">
                    <optgroup label="SubjectsView">
                        <option value="all">All Subjects</option>
                        <option value="following">Users you follow</option>
                        <option value="CompSci">CompSci</option>
                        <option value="Economics">Economics</option>
                        <option value="Maths">Maths</option>
                        <option value="Music">Music</option>
                        <option value="English">English</option>
                    </optgroup>
                </select>
                <p><input type="submit" value="Filter"></p>
            </form>
            <?php
            // || $_SESSION['subjectView'] == 'all'
            if ($_POST['subjectView'] == 'all') {
            $sql = "SELECT * FROM tblPosts ORDER BY post_date DESC";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            $rowId = $row['post_id'];
            //main post
            writePost($row);
            echo "<div class=\"comment\"> <p> &nbsp;  Comments: </p></div>";
            //comments
            $cSql = "SELECT * FROM tblComments WHERE post_id= '$rowId' ORDER BY comment_date DESC";
            $cResult = $connect->query($cSql);

            writeComment($cResult);

            ?>
            <form name="writeForm" action="comment.php" method="post">
                <p>Write a comment:</p>
                <p> <textarea name="userComment" id="userComment" placeholder="Type here..." rows="6" cols="101"></textarea></p>
                <button type="submit" name="commentBtn" value="<?=$row['post_id']?>" id="<?=$row['post_id']?>">Comment.</button>
            </form>
        </div>
        <br><br>
        <?php

        }
        } else {
            echo "0 results";
        }

        } elseif ($_POST['subjectView'] == 'following') {

        $user = $_SESSION['id'];
        $sql = "SELECT * FROM tblFollowers WHERE follower_id= '$user'";
        $fResult = $connect->query($sql);

        if ($fResult->num_rows > 0) {
        while ($row = $fResult->fetch_assoc()) {
        $fRowId = $row['user_id'];
        $sql = "SELECT * FROM tblPosts WHERE user_id= '$fRowId' ORDER BY post_date DESC";
        $result = $connect->query($sql);
        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        $rowId = $row['post_id'];
        //main post
        writePost($row);
        echo "<div class=\"comment\"> <p> &nbsp;  Comments: </p></div>";
        //comments
        $cSql = "SELECT * FROM tblComments WHERE post_id= '$rowId' ORDER BY comment_date DESC";
        $cResult = $connect->query($cSql);

        writeComment($cResult);
        ?>
        <form name="writeForm" action="comment.php" method="post">
            <p>Write a comment:</p>
            <p> <textarea name="userComment" id="userComment" placeholder="Type here..." rows="6" cols="101"></textarea></p>
            <button type="submit" name="commentBtn" value="<?=$row['post_id']?>" id="<?=$row['post_id']?>">Comment.</button>
        </form>
    </div>
    <br><br>
    <?php

    }
    } else {
        echo "0 results";
    }
    }
    }


    } else {
    //if the user has changed the filter
    $data = $_POST['subjectView'];
    $sql = "SELECT * FROM tblPosts WHERE post_subject= '$data' ORDER BY post_date DESC";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    $rowId = $row['post_id'];
    //main post
    writePost($row);
    echo "<div class=\"comment\"> <p> &nbsp;  Comments: </p></div>";
    //comments
    $cSql = "SELECT * FROM tblComments WHERE post_id= '$rowId' ORDER BY comment_date DESC";
    $cResult = $connect->query($cSql);

    writeComment($cResult);
    ?>
    <form name="writeForm" action="comment.php" method="post">
        <p>Write a comment:</p>
        <p> <textarea name="userComment" id="userComment" placeholder="Type here..." rows="6" cols="101"></textarea></p>
        <button type="submit" name="commentBtn" value="<?=$row['post_id']?>" id="<?=$row['post_id']?>">Comment.</button>
    </form>
</div>
<br><br>
<?php

}
} else {
    echo "0 results";
}
}
?>
</div>
</div>
<div class="rightcolumn">


    <?php
    $user = $_SESSION['id'];
    $sql = "SELECT * FROM tblPosts WHERE user_id= '$user' ORDER BY post_date DESC LIMIT 1";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            writePost($row);
        }
    }
    ?>
    <div class="post">
        <h3>Popular Post</h3>

    </div>
    <div class="post">
        <h3>Follow Me</h3>
        <p>Some text..</p>
    </div>
</div>
</div>

<!--<div class="footer">-->
<!--    <h2>Cultivate</h2>-->
<!--</div>-->

</body>
</html>
