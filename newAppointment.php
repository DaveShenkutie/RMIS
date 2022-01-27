<?php
	// include('include/connect_db.php');
	$email=$pid=$duplication=$failed=$success=$none=$_SESSION['none']=$date="";
	if(isset($_POST['save'])){
		$emp=$_SESSION['id'];
		$email=$_POST['CustEmail'];
		$pid=$_POST['pid'];
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

        $cust=$con->query("SELECT * FROM users WHERE Email='$email'")or die(mysql_error());
        $custResult=$cust->fetch();
        if($custResult){
			$sql=$con->query("INSERT INTO appointment (`id`, `date`, `timePeriod`, `pid`, `empId`, `custEmail`) 
            VALUES ('$id','$date','$time','$pid','$agent','$email')");
			if($sql) 
			{
				$success='<font color="Green"><em><strong>You have Succussfully set an appointment. </strong></em></font>';
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
    }else
    {
        $none='<font color="Red"><strong>Please choose a Registered customer email,this one doesnt exist. </strong></font>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include ('include/head.php');?>
<link rel="stylesheet" href="style/table.css" type="text/css" media="screen" /> 
<head>
</head>
<body class="sb-nav-fixed">
        <?php include ('include/header.php');?>
        <div id="layoutSidenav">
        <!-- <?php include ('include/sidebar.php');?> -->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4" >
                        <div class="card mb-4">
                             <div class="card-header">
                               <img src="../images/apointment.png" alt="tabel" title="table" width="40px"> 
                             <em> <strong>Appointment</strong> </em>
                            </div>
                            <br>
                            <h5> Fill the following form to <em> <strong>set an appointment</strong> </em>.</h5> 
                            <hr/>	      
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
                                        <tr><td ><input name="pid" type="number"  placeholder="Property ID" value="<?php echo $pid;?>" required="required" id="pid" /></td></tr>
                                            <tr><td><?php echo $none;?></td></tr>
                                        <tr><td ><input name="CustEmail" type="email" placeholder="customer email" value="<?php echo $email;?>" required="required" id="CustEmail"/></td></tr> 			
                                        <tr><td>
                                        <fieldset>
                                        <span >
                                        <legend id="requirements"> <hr> Appointment Date and Time</hr> </legend>
                                            <label for="date"> <br> </label>
                                            <input type="date" id="date" name="date" required value="<?php echo $date;?>">
                                        </span><hr>
                                        </fieldset>
                                        </td></tr>  
                                        <tr><td>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <input class="btn btn-primary btn-block" type="submit" name="save"placeholder="choose date" value="Set Appointment" style="width:400px;"/>
                                    
                                        <br>
                                    </div>	
                                    </td></tr>
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
        <?php include ('include/extra.php');?>
</body>
</html>