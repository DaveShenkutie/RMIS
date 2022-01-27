<?php
include('include/connect_db.php');
$_SESSION['end']=0;
?>
<script>
	$(document).ready(function()
	{
	$("#period1").change(function() 
		{	
			var period=$("#period1").val();
			if(period.length >0)		
				{
					$.ajax(
				{
					type: "POST", url: "checkDate.php", data: 'period='+period , success: function(msg)
					{  
					$("#viewer2").ajaxComplete(function(event, request, settings)
						{ 							
								if(msg)
								{  
									$(this).html(msg);
								} 
								else
								{
									$(this).html('<font color="white"><strong>There is no free agent with the selected period, try another period.</strong></font>');
								}	   
						});
					}    
				}); 
				}
		});		
	});
	$(document).ready(function()
	{
	$("#period2").change(function() 
		{	
			var period=$("#period2").val();
			if(period.length >0)		
				{
					$.ajax(
				{
					type: "POST", url: "checkDate.php", data: 'period='+period , success: function(msg)
					{  
					$("#viewer2").ajaxComplete(function(event, request, settings)
						{ 							
								if(msg)
								{  
									$(this).html(msg);
								} 
								else
								{
									$(this).html('<font color="white"><strong>There is no free agent with the selected period, try another period.</strong></font>');
								}	   
						});
					}    
				}); 
				}
		});		
	});
	$(document).ready(function()
	{
	$("#period3").change(function() 
		{	
			var period=$("#period3").val();
			if(period.length >0)		
				{
					$.ajax(
				{
					type: "POST", url: "checkDate.php", data: 'period='+period , success: function(msg)
					{  
					$("#viewer2").ajaxComplete(function(event, request, settings)
						{ 							
								if(msg)
								{  
									$(this).html(msg);
								} 
								else
								{
									$(this).html('<font color="white"><strong>There is no free agent with the selected period, try another period.</strong></font>');
								}	   
						});
					}    
				}); 
				}
		});		
	});
	$(document).ready(function()
	{
	$("#period4").change(function() 
		{	
			var period=$("#period4").val();
			if(period.length >0)		
				{
					$.ajax(
				{
					type: "POST", url: "checkDate.php", data: 'period='+period , success: function(msg)
					{  
					$("#viewer2").ajaxComplete(function(event, request, settings)
						{ 							
								if(msg)
								{  
									$(this).html(msg);
								} 
								else
								{
									$(this).html('<font color="white"><strong>There is no free agent with the selected period, try another period.</strong></font>');
								}	   
						});
					}    
				}); 
				}
		});		
	});
</script>
<?php
if(isset($_POST['date']))
{
	$pid=$_SESSION['pid'];
	$date=$_POST['date'];
	$_SESSION['date']=$date;
	$timePeriod=array("8:00 AM - 10:00 AM","10:00 AM - 12:00 PM","1:00 PM - 3:00 PM","3:00 PM - 5:00 PM");
	$workTime=array();
	$date=trim($date);
	$result = $con->query("SELECT timePeriod FROM appointment WHERE pid='$pid' AND date='$date'") or die(mysql_error());
	echo "<table  width=\"100%\" border=0 id='time'>";
	echo'<tr><th  id="time" ><font color="blue" size="5px"	>
	<p>Please select the time that suits you most.</p>';
	//check free time for the selected specific property from appointmant table
		$index=0;
		while($data = $result->fetch())
		{
			$workTime[$index]=$data['timePeriod'];
			++$index;
		}
	if($index==4){
		echo "There is no free time With the selected date, choose another date.";
	}

	//check whick time interval is free
		$freeTimePeriod= array_diff($timePeriod,$workTime);
	//display
		echo '<form action="newAppointment.php" method="post">';
		if(array_search("8:00 AM - 10:00 AM",$freeTimePeriod)!='') 
		{
			?>
			<input type="radio"  id="period1"  name="period" value="8to10">
			<label for="period1">8:00 AM - 10:00 AM</label><br>
			<?php
		}
		if(array_search("10:00 AM - 12:00 PM",$freeTimePeriod)!='') 
		{
			?>
			<input type="radio"  id="period2" name="period" value="10to12">
			<label for="period2">10:00 AM - 12:00 PM</label><br> 
			<?php
		}

		if(array_search("1:00 PM - 3:00 PM",$freeTimePeriod)!='') 	
		{
			?>
			<input type="radio"  id="period3" name="period" value="1to3">
			<label for="period3">1:00 PM - 3:00 PM</label><br>
			<?php
		}
		if( array_search("3:00 PM - 5:00 PM",$freeTimePeriod) !='') 
		{ 
		
		?>
			<input type="radio" id="period4" name="period" value="3to5">
			<label for="period4">3:00 PM - 5:00 PM</label><br><br> </th></tr></font>
		<?php
		}
		?>
	</font></form>
		<style>
			#ih{
			border: white 1px solid;
			border-radius: 10px !important;
			background-color: #ffffffcc !important;
			size: 23px;
			}
		</style>
	</table>
<?php				
}
if(isset($_POST['period']))
{
	echo "<table  width=\"100%\" border=0 id='time'>";
	echo'<tr><th  id="time" ><font color="blue" size="5px"	>';
	 function changeTime($t){
	    switch($t){ 
	        case '8to10':
	        $time="8:00 AM - 10:00 AM";
	        break;
			
	        case '10to12':
	        $time="10:00 AM - 12:00 PM";
	        break;
			
	        case '1to3':
	        $time="1:00 PM - 3:00 PM";
	        break;
			
	        case '3to5':
	        $time="3:00 PM - 5:00 AM";
	        break;   
	        default:
	        break;
	        }
	       return $time;
	   }
	   $time=trim($_POST['period']);
	$_SESSION['time']=changeTime($time);
	
	$check=array(4,4,4,4);	
	$time=$_SESSION['time'];
	$date=$_SESSION['date'];	
	$workTime=array();
	$result = $con->query("SELECT * FROM employee WHERE  type='Field Agent'") or die(mysql_error());
	//Ranking agents free time with selected date so that the agent with the highest free time will be assigned
	while($data = $result->fetch())
	{
		$empId=$data['empId'];
		$result1 = $con->query("SELECT * FROM appointment WHERE  empId='$empId' AND date='$date'") or die(mysql_error());
		$count=0;
		while($data1 = $result1->fetch())
		{
			$count=$count+1;
		} 
		$workTime[$empId]=$count;
	}
	// 
	function myfunction($v1,$v2)
	{
		if ($v1===$v2)
		{
		return "same";
		}
		else
		{
			return 1;	
		}
	}
	$condition=0;
	//$workTime=Array ( "agent/0000" => 4 ,"agent/4499" => 3, "agent/5593" => 4, "agent/9572]" => 4 );
	//print_r($workTime);
	
	if(sizeof($workTime)===4)
	{
		$x=array_search(1,(array_map("myfunction",$check,$workTime)));
		if($x=='')
		{
			echo "Please choose another date there is no free agent on ",$date,".";
			$condition=1;
		}
		else
		{
			goto selectAgent;
		}
	}
	else{
		goto selectAgent;	
	}
	// $first_key = array_key_first($worktime);
	// echo "<br>",$first_key,"<br>";
	 
	selectAgent:
	asort($workTime);
	$first_key = array_key_first($workTime);
	$_SESSION['agent']=trim($first_key);
	$agent=$_SESSION['agent'];
	if($condition==0){
		$_SESSION['end']=1;
		echo "ClicK 'Set Appointment' Button to save the Appointment <br>";
	}
	echo '</font></form>
		<style>
			#ih{
			border: white 1px solid;
			border-radius: 10px !important;
			background-color: #ffffffcc !important;
			size: 23px;
			}
		</style>
	</table>';
}
?>