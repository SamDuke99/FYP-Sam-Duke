<?php

include("database/db.php");
include("includes/header.php");

$_SESSION['receive'] = $_POST['viewMess'];
$data = ['id' => $_SESSION['receive']];
$rUser = selectOne('tblUser', $data);
$rId = $rUser['id'];
?>

<html>
<head>
    <link rel="stylesheet" href="../assets/messageStyles.css">
</head>

<body>

<div class="message">
    <h2><?php echo "You are viewing {$rUser['username']}'s messages"?></h2>
    <?php

    $sql = "SELECT * FROM tblMessages WHERE sender_id='$rId' ORDER BY message_date ASC;";
    $sResult = $connect->query($sql);
    if ($sResult->num_rows > 0) {
        while ($row = $sResult->fetch_assoc()) {
                echo "<div class=\"rightMsg\">";
                echo "<h3> &nbsp;  " . $row["message_content"] . "</h3>";
                echo "<p> &nbsp;  " . $row["sender_name"] . "</p>";
                echo "<p> &nbsp;  " . $row["message_date"] . "</p>";
                echo "</div>";
                echo "<br>";
            }
    }
    ?>
</div>

</body>

</html>
