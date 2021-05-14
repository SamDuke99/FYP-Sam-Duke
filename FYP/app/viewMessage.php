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
    <h2><?php echo "{$rUser['username']}"?></h2>
    <?php

    $sql = "SELECT * FROM tblMessages WHERE sender_id IN('$rId','$myId') AND receiver_id IN ('$rId','$myId') ORDER BY message_date DESC;";
    $sResult = $connect->query($sql);
    if ($sResult->num_rows > 0) {
        while ($row = $sResult->fetch_assoc()) {
            if ($row['receiver'] = $rId) {
                echo "<div class=\"leftMsg\"> <p> &nbsp;  " . $row["message_content"] . "</p></div>";
                echo "<br>";
            } elseif ($row['receiver'] = $myId) {
                echo "<div class=\"rightMsg\"> <p> &nbsp;  " . $row["message_content"] . "</p></div>";
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
