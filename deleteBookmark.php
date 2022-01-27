<?php

include('include/connect_db.php');
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="delete from bookmarks where propertyID='$id'";
    $con->query($sql);
    include('bookmark.php');
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/bookmark.php");
exit();
}
?>