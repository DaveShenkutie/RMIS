<?php
    include('include/connect_db.php');
    $end=$_SESSION['end'];
	$email=$pid=$duplication=$failed=$success=$none=$_SESSION['none']=$date="";
	if(isset($_POST['save'])){
        $email = $_SESSION['email'];
        $pid = $_SESSION['pid'];
        $_SESSION['email'] = $email;
        $_SESSION['pid'] = $pid;

		
		$date=$_POST['date'];
        $agent=$_SESSION['agent'];
        $time=trim($_SESSION['time']);

        $getId=$con->query("SELECT 1+MAX(id) FROM appointment");
        $prevId=$getId->fetch();
       
        if($prevId[0]=='')
        {
            $id=1;
        }
        else
        {
            $id=$prevId[0];
        }
            
			$sql=$con->query("INSERT INTO appointment (`id`, `date`, `timePeriod`, `pid`, `empId`, `custEmail`) 
            VALUES ('$id','$date','$time','$pid','$agent','$email')");
			if($sql) 
			{
				$success='<font color="Green"><em><strong>You have Succussfully set an appointment. check your email or got appointment list page </strong></em></font>';
				$_SESSION['success']=$success;	
                $agent = $con->query("SELECT phone,firstName,lastName,email FROM employee WHERE  empId='$agent'") or die(mysql_error());
                $fetch=$agent->fetch();
                $phone=$fetch['phone'];
                $fn=$fetch['firstName'];
                $ln=$fetch['lastName'];
                $agentEmail=$fetch['email'];
                
                $agent = $con->query("SELECT address FROM property WHERE  id='$pid'") or die(mysql_error());
                $fetch=$agent->fetch();
                $address=$fetch['address'];
                $sender='From: dawitshenkutie@gmail.com';
                $subject='Appointment Information'; 
                $body="Dear Esteemed Customer,
                 Your appointment and contact informations are listed below 
                        Date: ".$date."
                        Time: ".$time."
                        Location: ".$address."
                 Contact our Agent
                        Agent Name: ".$fn." ".$ln."  
                        Phone Number: 0".$phone." 
                        Email: ".$agentEmail."
kind regards,
Gift Real Estate. ";

mail($email, $subject, $body, $sender);

//for the customer notification via email 

                $cust = $con->query("SELECT Phone,FirstName,LastName,Email FROM users WHERE  Email='$email'") or die(mysql_error());
                $fetch=$cust->fetch();
                $phone=$fetch['Phone'];
                $FN=$fetch['FirstName'];
                $ln=$fetch['LastName'];

$body="Dear ".$fn. " you have new Appointment,
                 Your appointment and contact informations are listed below 
                        Date: ".$date."
                        Time: ".$time."
                        Location: ".$address."
                        Customer Name: ".$FN." ".$ln."  
                        Phone Number: 0".$phone." 
                        Email: ".$email."
kind regards,
Gift Real Estate. ";
            mail($agentEmail, $subject, $body, $sender);

                $info='<font color="Green"><em><strong> we have emailed a notification for both the Agent and the cusomer.</strong></em></font>';
				// //header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/reservationList.php");
			}
			else
			{
				$failed='<font color="Red"><strong>appointment scheduling Failed, Try again. </strong></font>';
                $_SESSION['faild']=$failed;
					
			}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
    <link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
    <link rel="stylesheet" href="style/table.css" type="text/css" media="screen" /> 
       <!-- ajax genenator -->
    <script type="text/javascript" SRC="js/jquery-1.4.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>
<?php
include('include/header.php');
include('include/connect_db.php');
?>
<div class="sub-banner overview-bgi">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>Set Appointment</h1>
            <ul class="breadcrumbs">
                <li><a href="index.php">Properties</a></li>
                <li class="active">New Appointment</li>
            </ul>
        </div>
    </div>
</div>
<script>
    $(document).ready(function()
    {
    $("#date").change(function() 
        {	
            var date=$("#date").val();
            if(date.length >0)		
                {
                    $.ajax(
                {
                    type: "POST", url: "checkDate.php", data: 'date='+date , success: function(msg)
                                    
                    {  
                    $("#viewer2").ajaxComplete(function(event, request, settings)
                        { 							
                                if(msg)
                                {  
                                    
                                    $(this).html(msg);
                            
                                } 
                                else
                                {
                                    
                                    $(this).html('<font color="white"><strong>There is no free agent with the selected date, try another date.</strong></font>');
                                }	   
                        });
                    }    
                }); 
                }
        });		
        });
</script>
<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="contact-1 content-area-7">
                <div class="container">
                    <div class="main-title">
                        <h1>Appointment</h1>
                        <p>MARK YOUR AGENDA</p>
                    </div>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Schedule</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Appintment</a></li>
                            <li class="breadcrumb-item active">New</li>
                        </ol>
                        <script>
                            $(document).ready(function()
                            {
                            $("#date").change(function() 
                                {	
                                    var date=$("#date").val();
                                    if(date.length >0)		
                                        {
                                            $.ajax(
                                        {
                                            type: "POST", url: "checkDate.php", data: 'date='+date , success: function(msg)
                                                            
                                            {  
                                            $("#viewer2").ajaxComplete(function(event, request, settings)
                                                { 							
                                                        if(msg)
                                                        {  
                                                            
                                                            $(this).html(msg);
                                                    
                                                        } 
                                                        else
                                                        {
                                                            
                                                            $(this).html('<font color="white"><strong>There is no free agent with the selected date, try another date.</strong></font>');
                                                        }	   
                                                });
                                            }    
                                        }); 
                                        }
                                });		
                                });
                        </script>
                        <div class="card mb-4">
                            <div class="card-body">
                               Please choose the Date then time that best suits your schedule
                               <main>
                                <div class="container-fluid px-4" >	      
                                    <script>
                                        $(document).ready(function()
                                        {
                                        $("#pid").change(function() 
                                            {	
                                                var pid=$("#pid").val();
                                                if(pid.length >0)		
                                                    {
                                                        $.ajax(
                                                    {
                                                        type: "POST", url: "properyListHint.php", data: 'pid='+pid , success: function(msg)
                                                                        
                                                        {  
                                                        $("#viewer2").ajaxComplete(function(event, request, settings)
                                                            { 							
                                                                    if(msg)
                                                                    { 
                                                                        
                                                                        $(this).html(msg);
                                                                
                                                                    } 
                                                                    else
                                                                    {
                                                                        
                                                                        $(this).html('<font color="white"><strong>The Property Id you entered does not exist, try another ID. </strong></font>');
                                                                    }	   
                                                            });
                                                        }    
                                                    }); 
                                                    }
                                            });		
                                        });	
                                        $(document).ready(function()
                                        {
                                        $("#date").change(function() 
                                            {	
                                                var date=$("#date").val();
                                                if(date.length >0)		
                                                    {
                                                        $.ajax(
                                                    {
                                                        type: "POST", url: "checkDate.php", data: 'date='+date , success: function(msg)
                                                                        
                                                        {  
                                                        $("#viewer2").ajaxComplete(function(event, request, settings)
                                                            { 							
                                                                    if(msg)
                                                                    {  
                                                                        
                                                                        $(this).html(msg);
                                                                
                                                                    } 
                                                                    else
                                                                    {
                                                                        
                                                                        $(this).html('<font color="white"><strong>There is no free agent with the selected date, try another date.</strong></font>');
                                                                    }	   
                                                            });
                                                        }    
                                                    }); 
                                                    }
                                            });		
                                            });
                                    </script>
                                    <div id="content_1" class="content"> 
                                        <div id="viewer1"><span id="viewer2"></span></div>
                                        <?php echo $duplication,$failed,$success;?>
                                            <form action="<?php ($_SERVER["PHP_SELF"]);?>"  method="POST">
                                            <table width="220" height="106" border="0"  >
                                                <fieldset>
                                                <span >
                                                <legend id="requirements"> <hr> Choose Appointment Date Below </legend>
                                                    <label for="date"> <br> </label>
                                                    <input type="date" id="date" name="date" required value="<?php echo $date;?>">
                                                </span><hr>
                                                </fieldset>
                                                </td></tr>  
                                                <?php 
                                                if(isset($end)){
                                                ?><tr><td>
                                                    
                                                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <input class="btn btn-primary btn-block" type="submit" name="save"placeholder="choose date" value="Set Appointment" style="width:400px;"/>
                                            
                                                <br>
                                            </div>	
                                            </td></tr> <?php }?>
                                            </table>
                                            </form>         
                                        </div>  
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    <style>
                                        fieldset {
                                        border: #3090f0 1px ridge;
                                        border-radius: 10px;
                                        color: #000059;
                                        width: 400px;
                                        line-height: 1.9em;
                                        }
                                        #pid,#CustEmail {
                                        color: #000059;
                                        width: 400px;
                                        line-height: 1.9em;
                                        }
                                        table{
                                            border: #3090f0 1px ridge;
                                        }
                                        input,legend{
                                            margin-right: 6px;
                                            text-align: center;
                                        }
                                        /* #date,#pid {
                                            margin-left: 70px;
                                        } */
                                        #date{
                                            color: #000059;
                                            width: 380px;
                                            line-height: 1.9em;
                                            margin-left: 1px;
                                        }
                                    </style>                           
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include 'include/extra.php'; ?>

<body>

</body>

</html>