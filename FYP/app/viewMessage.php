<?php
include("database/db.php");
include("includes/header.php");

$_SESSION['receive'] = $_POST['viewMess'];
$data = ['id' => $_SESSION['receive']];
$myId = $_SESSION['id'];
$rUser = selectOne('tblUser', $data);
$rId = $rUser['id'];
?>

<html>
<head>
    <link rel="stylesheet" href="../assets/messageStyles.css">
</head>

<body>

<div class="message">
    <h2><?php echo "You are chatting to {$rUser['username']}"?></h2>
    <?php

    $sql = "SELECT * FROM tblMessages WHERE sender_id IN('$rId','$myId') AND receiver_id IN('$rId','$myId') ORDER BY message_date ASC;";
    $sResult = $connect->query($sql);
    $seen = ['message_seen' => 1];

    if ($sResult->num_rows > 0) {
        while ($row = $sResult->fetch_assoc()) {
            if ($row['receiver_id'] == $myId) {
                echo "<div class=\"leftMsg\">";
                echo "<h3> &nbsp;  " . $row["message_content"] . "</h3>";
                echo "<p> &nbsp;  " . $row["sender_name"] . "</p>";
                echo "<p> &nbsp;  " . $row["message_date"] . "</p>";
                update('tblMessages', $row['id'], $seen);
                echo "</div>";
                echo "<br>";
            } elseif ($row['receiver_id'] == $rId) {
                echo "<div class=\"rightMsg\">";
                echo "<h3> &nbsp;  " . $row["message_content"] . "</h3>";
                echo "<p> &nbsp;  " . $row["sender_name"] . "</p>";
                echo "<p> &nbsp;  " . $row["message_date"] . "</p>";

                echo "</div>";
                echo "<br>";
            }
        }
    }
    ?>
    <form name="messageForm" action="sendMessage.php" method="post">
        <p> <textarea name="userMessage" id="userMessage" placeholder="Type here..." rows="6" cols="101"></textarea></p>
        <button type="submit" name="messageBtn">Send</button>
    </form>
</div>

</body>

</html>
