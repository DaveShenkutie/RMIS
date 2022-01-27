

<!-- customer login page validation -->

<?php

include('include/connect_db.php');
$same="";
if(isset($_POST['login'])){
    $password=$_POST['password']; 
    $email=trim($_POST['email'])    ;
    $_SESSION['email']=$email;
    $sql1=$con->query("SELECT * FROM users WHERE Email='$email'")or die(mysql_error());
    $result=$sql1->fetch();
    if($result){
        $hashed_password=trim($result['Password']);
//$same="THIS IS WORKING";    
        if(password_verify($password, $hashed_password)) 
        {
        header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
      }
    }else
    {
      $same="Please Enter a Correct Email and Password";
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
        <title> Gift Real Estate-Login</title>
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
                                    <h4 class="text-center font-weight-light my-4">Login   </h4></div>
                                    <div class="card-body">
                                    <!-- customer login page form -->
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                    <div class="form-floating mb-3">
                                    <span class="error" style="color:red;font-weight:bold "><?php echo $same ;?></span>   
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" name="email" />
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a  href="password.php">Forgot Password?</a>
                                                <input class="btn btn-primary btn-block" type="submit" value="Login" name="login"/>
                                            </div>
                                        </form>

                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <ph
                include('inclu/footer.php');
            ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
