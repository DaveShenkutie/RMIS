<?php
include('include/connect_db.php');

if(isset($_POST['pid']))
{
	$pid=$_POST['pid'];
	$_SESSION['pid']=$pid;
	$getDetails=$con->query("SELECT id,property_title,address,price FROM property WHERE id='$pid'");
	echo "<table width=\"100%\" border=0>";
		if($item5=$getDetails->fetch())
		{
			echo "<tr> 
			<th>ID </th>
			<th>Title </th>
			<th>Address</th>
			<th>Price(Br.) </th>
			</tr>";
			echo "<tr>";
			echo '<td align="right">' . $item5['id'] . '</td>';
			echo '<td align="right">' . $item5['property_title'] . '</td>';
			echo '<td align="right">' . $item5['address'] . '</td>';
			echo '<td align="right">' . number_format($item5['price'],2) . '</td>';
			echo "</tr>";
		
		}
		else
		{	
			$msg='<font color="white"><strong>The Property Id you entered does not exist, try another ID. </strong></font>';
			echo $msg;
		}
		echo "<style>
		td,th{
			border: white 1px ridge;
		}
		</style>";
	echo "</table>"; 				
}


?>