<?php

include('include/connect_db.php');
    $email=$same=$verification=$pwErr="";
    $email=$_SESSION['email'];
if(isset($_POST['submit'])){
    $verification=$_POST['verification'];
    $verification=trim($verification);  
    $code=$_SESSION['code'];  
    $_SESSION['email']=$email; 
    if (strcmp( $code,$verification)!=0) 
    {
    $pwErr = "The code doesn't match.";
    }
    else
    {
       header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/resetPassword.php");        
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
        <title>Password Reset</title>
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
                                    <h3 class="text-center font-weight-light my-4">Password Recovery</h3></div>
                                    <div class="card-body">
                                        <div class="small mb-3 text-muted">Enter the four digit code that we sent via your email <?php echo $email;?> .</div>
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                        <div class="form-floating mb-3">
                                            <span class="error" style="color:red;font-weight:bold "><?php echo $same,$pwErr;?></span>
                                             </div>
                                             <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="number" name="verification" placeholder="0000" value="<?php echo $verification; ?>" />
                                                <label for="verification">verification</label>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="selectId.php">Resend code</a>
                                                <div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                <input class="btn btn-primary btn-block" type="submit" value="Reset Password" name="submit"/>
                                                </div>
                                                </div> 
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
