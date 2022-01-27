
<?php
session_start();
include('include/header.php');
include ('include/connect_db.php');

if(isset($_POST['update'])){
    $fn= $_POST['firstname'];
    $ln= $_POST['lastname'];
    $email= $_POST['email'];
    $city= $_POST['City'];  
    $subcity= $_POST['subcity'];  
    $kebele= $_POST['kebele'];  
    $woreda= $_POST['woreda'];  
    $phone= $_POST['phone'];  
        
        $sql=$con->query("UPDATE users SET FirstName='$fn', LastName='$ln', Email='$email', City='$city', Phone='$phone', Subcity='$subcity', Woreda='$woreda', Kebele='$kebele'   WHERE Email = 'amanuelbeyene47@gnail.com' "  );
        if($sql) 
        {
            header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
        }
        else
        {
            $same1="profile update failed, Try again";
        }
}
else{
    echo "else satement";
}        


//  if($p==0) {} else {$p=$row['Phone'];}
//  if($k==0) {} else {$k=$row['Kebele'];}
//  if($w==0) {} else {$w=$row['Woreda'];}
 
//     $email=$_SESSION['email'];
//     $result = $con->query("SELECT * FROM users where email = '$email' ") or die(mysql_error());
//     $row = $result->fetch();
    
//     $nf= $row['FirstName'];
//     $nl=$row['LastName'];
//     $e=$row['Email'];
//     $c=$row['City'];
//     $sc=$row['Subcity'];
                                                                
?> 
             
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
                <form  method="POST" action="<?php ($_SERVER["PHP_SELF"]);?>"> 
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group name">
                                <input type="text" name="firstname" class="form-control" placeholder="First Name" value="<?php echo $nf?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group name">
                                <input type="text" name="lastname" class="form-control" placeholder="Last Name" value="<?php echo $nl?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group email">
                                <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $e?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group subject">
                                <input type="text" name="city" class="form-control" placeholder="City"  value="<?php echo $c?>" >
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group number">
                                <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="<?php echo $p?>" > 
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group subject">
                                <input type="text" name="subcity" class="form-control" placeholder="Sub City" value="<?php echo $sc?>" >
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group subject">
                                <input type="text" name="woreda" class="form-control" placeholder="Woreda" value="<?php echo $w?>" >
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group subject">
                        <input type="text" name="kebele" class="form-control" placeholder="Kebele" value="<?php echo $k?>" >
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                    <input class="btn btn-primary btn-block" type="submit" name="update" value="update entry" style="width:400px;"/>
                    <br>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- edit profile end -->


<!-- Footer start -->
<?php include('include/footer.php');?>