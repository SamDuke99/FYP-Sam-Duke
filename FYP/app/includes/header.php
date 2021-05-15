

<link rel="stylesheet" href="../assets/mainStyles.css">
<div class="header">
    <img src="../assets/img_logo.jpg" width="80" height="121" alt="logo" />
    <h1>Cultivate</h1>
    <div class="navBar">
        <a href="../app/mainPage.php">Home</a>
        <a href="../app/myProfile.php">My Profile</a>
        <a href="../app/messageList.php">Messages</a>
        <a href="login.php">Log Out</a>
        <div class="dropdown">
            <button class="dropBtn">Notifications
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <?php
                $nUser = $_SESSION['id'];
                $nSql = "SELECT * FROM tblMessages WHERE message_seen=0 AND receiver_id= '$nUser'";
                $nResult = $connect->query($nSql);
                if ($nResult->num_rows > 0) {
                    while ($nRow = $nResult->fetch_assoc()) {
                        echo "<a href='../app/messageList.php'>New message from: " . $nRow['sender_name'] ."</a>";

                    }
                }
                $fSql = "SELECT * FROM tblFollowers WHERE follow_seen=0 AND user_id= '$nUser'";
                $fResult = $connect->query($fSql);
                if ($fResult->num_rows > 0) {
                while ($fRow = $fResult->fetch_assoc()) {
                    echo "<a href='#'>New follower: " . $fRow['follower_name'] ."</a>";
                    update('tblFollowers', $fRow['id'], ['follow_seen' => 1]);
                }
                }
                ?>
            </div>
        </div>
        <?php  if ($_SESSION['admin'] === 1) : ?>
        <a href="../app/admin.php"> Admin </a>
        <?php  endif; ?>
        <form name="search" action="../app/search.php" method="post">
            <input type="text" id="searchBar" placeholder="Search.." name="searchBar">
            <button type="submit">Submit</button>
        </form>
        <a href="../app/myProfile.php" style="float:right"><?php echo $_SESSION['username']; ?></a>
    </div>
</div>