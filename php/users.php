<?php
session_start();
include_once "config.php";
$outgoing_id = $_SESSION['unique_id'];
$sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY user_id DESC";
$query = mysqli_query($conn, $sql);
$output = "";

if (mysqli_num_rows($query) == 0) {
    $output .= "No hay usuarios disponibles";
} elseif (mysqli_num_rows($query) > 0) {
    include_once "data.php";
}

$sql2 = "SELECT 
	g.group_id, 
	g.uniqueGroup_id as unique_id,
    g.Group_name as fname, 
    CASE 
		WHEN lname IS NULL THEN ' '
		ELSE ' '
		END as lname ,
    g.img,
    `status` 
FROM `groups` AS g
left join `groups_users` as gu on g.uniqueGroup_id = gu.uniqueGroup_id
left join `users` as u on gu.uniqueUser_id = u.unique_id
WHERE u.unique_id = {$outgoing_id} ; ";
$query2 = mysqli_query($conn, $sql2);

if (mysqli_num_rows($query2) > 0) {
    include_once "data_group.php";
}


echo $output;
?>