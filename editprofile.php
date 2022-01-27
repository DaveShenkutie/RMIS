<?php
include('include/header.php');
include('include/connect_db.php');

 

     

 if ($p == 0) {
} else {
    $p = $row['Phone'];
}
if ($k == 0) {
} else {
    $k = $row['Kebele'];
}
if ($w == 0) {
} else {
    $w = $row['Woreda'];
}

$email = $_SESSION['email'];
$result = $con->query("SELECT * FROM users where email = '$email' ") or die( mysqli_connect_error());
$row = $result->fetch();

$nf = $row['FirstName'];
$nl = $row['LastName'];
$e = $row['Email'];
$c = $row['City'];
$sc = $row['Subcity'];
$p=$row['Phone'];
$k=$row['Kebele'];
$w=$row['Woreda'];
?>

<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
<!-- main header end -->

<!-- Sub banner start -->
<div class="sub-banner overview-bgi">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>Edit Profile</h1>
            <ul class="breadcrumbs">
                <li><a href="index.php">Home</a></li>
                <li class="active">Edit Profile</li>
            </ul>
        </div>
    </div>
</div>
<!-- Sub banner end -->

<!-- Contact 1 start -->
<div class="contact-1 content-area-7">
    <div class="container">
        <div class="main-title">
            <h1>Change Profile</h1>
            <p>Update Profile Detail </p>
        </div>

        <div class="row">
            <div class="col-lg-7 col-md-7 col-md-7">
                <form action="account.php" method="post" enctype="multipart/form-data" >
                    <div class="row">
                      
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group name" >
                                <input type="text" name="firstname" class="form-control" placeholder="First Name" value="<?php echo $nf ?>">
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group name">
                                <input type="text" name="lastname" class="form-control" placeholder="Last Name" value="<?php echo $nl ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group email">
                                <input type="email" name="email" class="form-control" placeholder="Email" required value="<?php echo $e ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group subject">
                                <input type="text" name="city" class="form-control" placeholder="City" value="<?php echo $c ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group number">
                                <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="<?php echo $p ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group subject">
                                <input type="text" name="subcity" class="form-control" placeholder="Sub City" value="<?php echo $sc ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group subject">
                                <input type="text" name="woreda" class="form-control" placeholder="Woreda" value="<?php echo $w ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group subject">
                                <input type="text" name="kebele" class="form-control" placeholder="Kebele" value="<?php echo $k ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group name">
                                <input type="file" name="profilephoto" class="form-control" placeholder="Upload your photo" >
                            </div>
                        </div>
                        <a href="account.php">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group subject">
                            <input class="btn btn-color btn-md btn-message" type="submit" name="submit">
                            </div>
                        </div>
                        </a>
                    </div>
            </div>
            </form>
            <script>
// This script is to preview the image before submitting the file
function displayPhoto(event){
    profileDisplay = document.getElementById('profiledisplay');
    profileDisplay.setAttribute('src', URL.createObjectURL(event.files[0]));
    profileDisplay.onload = function() {
    URL.revokeObjectURL(profileDisplay.src); // to free memory
    } 
}
</script>
        </div>



       
    </div>
</div>
</div>
<!-- edit profile end -->

<!-- Footer start -->
</body>
</html>
