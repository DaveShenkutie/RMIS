<?php

include('include/connect_db.php');
$password=$fn=$ln=$email=$confirm=$same=$same1=$pwErr ="";
if(isset($_POST['submit'])){
    $confirm=$_POST['confirm'];
    $password=$_POST['password']; 
    $fn=$_POST['fn'];
    $ln=$_POST['ln'];
    $email=$_POST['email'];
    
    if (strcmp( $password,$confirm)!=0) 
    {
       
    $pwErr = "Password doesn't match.";
    }
    else{
    
    $sql1=$con->query("SELECT * FROM users WHERE Email='$email'")or die(mysql_error());
    $result=$sql1->fetch();
    if($result){
        $same="There is a customer with the same email";
    }else
        {
            $password =password_hash(trim($password),PASSWORD_DEFAULT );
        $sql=$con->query("INSERT INTO users (FirstName,LastName,Email,Password)
        VALUES('$fn','$ln','$email','$password')");
        if($sql) 
        {
            header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/login.php");
        }
        else
        {
            $same1="Property registration Failed, Try again";
        }
    }        
}
}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register - Customer</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        
       
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                    
                                        <?php
                                        include ('logo.php');
                                        ?> 
                                        <h4 class="text-center font-weight-light my-4">Create Account</h4>
                                  
                                    </div>
                                    <div class="card-body">
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                    <div class="form-floating mb-3">
                                            <span class="error" style="color:red;font-weight:bold "><?php echo $same. $same1;?></span>
                                    </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputFirstName" type="text" name="fn" required placeholder="Enter your first name" value="<?php echo $fn;?>" />
                                                        <label for="inputFirstName">First name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputLastName" type="text" name="ln" required  placeholder="Enter your last name" value="<?php echo $ln;?>"/>
                                                        <label for="inputLastName">Last name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" name="email" required="required" placeholder="name@example.com" value="<?php echo $email;?>" />
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                            <span class="error" style="color:red;font-weight:bold "><?php echo $pwErr;?></span>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                   
                                                    <input class="form-control" id="inputPassword" type="password" name="password" required="required" placeholder="Create a password" value="<?php echo $password;?>"/>
                                                    <label for="inputPassword">Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                   
                                                        <input class="form-control" id="inputPasswordConfirm" type="password" name="confirm" required="required"placeholder="Confirm password" value="<?php echo $confirm;?>"/>
                                                         <label for="inputPasswordConfirm">Confirm Password</label> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                             <div class="d-grid">
                                                 <!-- <a class="btn btn-primary btn-block" href="login.php">  -->
                                                <a href="?customerList" name="CustomerList">
                                                     <input class="btn btn-primary btn-block" type="submit" value="Create Account" name="submit"/>
                                                </a>
                                            </div>
                                            </div> 
                                        </form> 
                                    </div> 
                                    <div class="card-footer text-center py-3"> 
                                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">&copy; Your Website 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
