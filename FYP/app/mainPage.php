<?php
include("database/db.php");
include("includes/header.php");
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
               <p> <textarea name="userPost" id="userPost" placeholder="Type here..." rows="6" cols="128"></textarea></p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p><input type="submit" name="postBtn" value="Submit"></p>
            </form>
        </div>
        </div>
        <div class="post">
            <?php
            $sql = "SELECT * FROM tblPosts ORDER BY post_date DESC";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class=\"post\"> <h2> Username: " . $row["user_name"] . "</h2></div>";
                    echo "<div class=\"postCont\"> <p>" . $row["post_contents"] . "</p></div>";
                    echo "<div class=\"post\"> <p>" . $row["post_date"] . "</p></div>";
                }
            } else {
                echo "0 results";
            }
            ?>
        </div>
    </div>
    <div class="rightcolumn">
        <div class="post">
            <h2>My Posts</h2>
            <div class="postCont" style="height:100px;">Image</div>
            <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
        </div>
        <div class="post">
            <h3>Popular Post</h3>
            <div class="postCont"><p>Image</p></div>
            <div class="postCont"><p>Image</p></div>
            <div class="postCont"><p>Image</p></div>
        </div>
        <div class="post">
            <h3>Follow Me</h3>
            <p>Some text..</p>
        </div>
    </div>
</div>

<div class="footer">
    <h2>Footer</h2>
</div>

</body>
</html>
