<?php
include("database/db.php");
include("includes/header.php");

$id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id=?"; // SQL with parameters
$stmt = $connect->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result
//$user = $result->fetch_assoc(); // fetch data
while ($row = $result->fetch_assoc()) {
    echo $row['name'];
}
?>

<html>
<body>



</body>
</html>
