<?php

include('include/connect_db.php');
$password=$confirm=$same="";
if(isset($_POST['submit'])){
    $confirm=$_POST['confirm'];
    $password=$_POST['password']; 
    $email=$_SESSION['email'];
    if (strcmp( $password,$confirm)!=0) 
    {
    $pwErr = "Password doesn't match.";
    }
    else
    {
        $password =password_hash(trim($password),PASSWORD_DEFAULT );
        $sql=$con->query("UPDATE users SET  Password='$password' WHERE Email='$email'");
        if($sql) 
        {
            header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/login.php");
        }
        else
        {
            $same="Unable to reset you passwoed, Try again";
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
        <title>Password Reset - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                    <?php
                                        include ('logo.php');
                                    ?> 
                                        <h3 class="text-center font-weight-light my-4">Password Recovery</h3></div>
                                    <div class="card-body">
                                    <div class="small mb-3 text-muted">Enter and confirm your new password.</div>
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                    <div class="form-floating mb-3">
                                     <span class="error" style="color:red;font-weight:bold "><?php echo $same,$pwErr;?></span>
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
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="login.php">Return to login</a>
                                                 <input class="btn btn-primary btn-block" type="submit" value="Reset Password" name="submit"/>
                                            </div>
                                        </form>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
