

<link rel="stylesheet" href="../assets/mainStyles.css">
<div class="header">
    <img src="../assets/img_logo.jpg" width="80" height="121" alt="logo" />
    <h1>Cultivate</h1>
    <div class="navBar">
        <a href="">My Profile</a>
        <a href="#">Groups</a>
        <a href="../app/messagePage.php">Messages</a>
        <a href="../app/mainPage.php">Home</a>
        <a href="login.php">Log Out</a>

        <?php  if ($_SESSION['admin'] === 1) : ?>
        <a href="../app/admin.php"> Admin </a>
        <?php  endif; ?>
        <form name="search" action="../app/search.php" method="post">
            <input type="text" id="searchBar" placeholder="Search.." name="searchBar">
            <button type="submit">Submit</button>
        </form>
        <a href="#" style="float:right"><?php echo $_SESSION['username']; ?></a>
    </div>
</div>