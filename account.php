<?PHP

include('connect_db.php');

if (isset($_POST['submit'])) {
    
    $email=$_SESSION['email'];
    if(empty($_FILES['profilephoto'])){
        $error = 'This field is required.';
    }
    else{
            $file_ext=strtolower(end(explode('.',$_FILES['profilephoto']['name'])));
            if(!in_array($file_ext,array('jpeg','gif','png','jpg',))){
                $error = 'JPG, JPEG, PNG and GIF are only supported.';
            }
            elseif($_FILES['profilephoto']['size']>2097152){
                $error = 'File should not be more than 2MB.';
            }
            else{
                //time() is added below to make the filename unique
                //change the folder directory according to your directory organization
                $target_dir = "assets/img/profilepics/";
                $target_file = $target_dir . basename($_FILES["profilephoto"]["name"]);
    
                // $newFileName = 'profile/'.$_FILES['profilephoto']['name'];
                $imageName=$_FILES['profilephoto']['name'];
    
                move_uploaded_file($_FILES["profilephoto"]["tmp_name"], $target_file);
                //file uploaded
                //panda you will just store the $newFileName to the database and when you retrieve you will put this filename in the <img src="fileNameFromDatabase"> to display
    
            }
    }
    $fn = $_POST['firstname'];
    $ln = $_POST['lastname'];
    $email = $_POST['email'];
    $_SESSION['email']=$email;
    
    $city = $_POST['city'];
    $subcity = $_POST['subcity'];
    $kebele = $_POST['kebele'];
    $woreda = $_POST['woreda'];
    $phone = $_POST['phone'];
    
    $sql = $con->query("UPDATE users SET  FirstName='$fn', LastName='$ln', Email='$email', 
            City='$city', Phone='$phone', Subcity='$subcity', Woreda='$woreda', Kebele='$kebele' , Profile_image='$imageName'   
            WHERE Email = '$email' ;");
    if ($sql) { 
        ?>
        
        <script type="text/javascript">
            alert("Saved Successfully.<?php echo $pic;?>");
        header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/account.php");
            
        </script> <?php

    } else 
    {
        $same1 = "profile update failed, Try again";
    }
}

?>
<style>
    .avatar {
        vertical-align: middle;
        width: 150px;
        height: 150px;
        border-radius: 50%;
    }
</style>
<script>
    function myFunction() {
        location.replace("editprofile.php")
    }
</script>


<?php
$email = $_SESSION['email'];
$result = $con->query("SELECT * FROM users where email = '$email' ") or die(mysql_error());
$row = $result->fetch();

$nf = $row['FirstName'];
$nl = $row['LastName'];
$e = $row['Email'];
$p = $row['Phone'];
$c = $row['City'];
$sc = $row['Subcity'];
$w = $row['Woreda'];
$k = $row['Kebele'];
$pic = $row['Profile_image']
?>


<!-- main header end -->
<?php include('include/header.php');


$name = $_SESSION['email'];

?>

<!-- Sub banner start -->
<div class="sub-banner overview-bgi">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>Account Profile</h1>
            <ul class="breadcrumbs">
                <li><a href="index.php">Home</a></li>
                <li class="active">Account Profile</li>
            </ul>
        </div>
    </div>
</div>
<!-- Sub banner end -->

<!-- Contact 1 start -->
<div class="contact-1 content-area-7">
    <div class="container">
        <div class="main-title">
            <h1>Account Profile</h1>
            <p>Your Accout Details </p>
        <img class='avatar' alt='Avatar' src='assets/img/profilepics/<?php echo $pic;?>'>  
 </div>
        <div class="row">
            <div class=" offset-lg-1 col-lg-4 offset-md-0 col-md-5">
                <div class="col-lg-7 col-md-7 col-md-7">
                    <div class="row">

                    
                        <div class="media">
                            <div class="media-body">
                                <br><br>
                                <h5 class="mt-0">Name</h5>
                                <p> <?php echo $nf . " " . $nl; ?> </p>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-body">
                                <h5 class="mt-0">Email</h5>
                                <p> <?php echo $e; ?> </p>
                            </div>
                        </div>

                        <div class="media">
                            <div class="media-body">
                                <h5 class="mt-0">Phone</h5>
                                <p> <?php echo $p; ?> </p> <br>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="send-btn">
                            <br> <button onclick="myFunction()" class="btn btn-color btn-md btn-message">Edit Profile</button>
                        </div>
                    </div>

                </div>

            </div>

            <div class=" offset-lg-1 col-lg-4 offset-md-0 col-md-5">
                <div class="contact-info">
                    <h3>Address</h3>

                    <div class="media">
                        <i class="fa fa-map-marker"></i>
                        <div class="media-body">
                            <h5 class="mt-0"></h5>

                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0">City</h5>
                                    <p> <?php echo $c; ?>
                                </div>
                            </div>

                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0">Sub City</h5>
                                    <p> <?php echo $sc; ?> </p>
                                </div>
                            </div>

                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0">Woreda</h5>
                                    <p> <?php echo $w; ?> </p>
                                </div>
                            </div>

                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0">Kebele</h5>
                                    <p> <?php echo $k; ?> <br>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Profile page end -->


<!-- Footer start -->
<?php include('include/footer.php'); ?>