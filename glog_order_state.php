<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_order_state"),true);

$arr = array();

foreach($data as $index=> $value)
{


 
	foreach($value as $inde => $valu)
	{

		foreach($valu as $ind => $val)
		{
				foreach($val as $i => $v)
				{
						

					$tbdata = $v;
					
					
					$arr[] = array($i => $tbdata);
					
					
					//array_push($arr, $tbdata);
				
				}
		}
		
	}


 
}

//var_dump($arr);
$id_order_state = array();
$invoice = array();
$send_email = array();
$module_name = array();
$color = array();
$unremovable = array();
$hidden = array();
$logable = array();
$delivery = array();
$shipped = array();
$paid = array();
$pdf_invoice = array();
$pdf_delivery = array();
$deleted = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_order_state')
		{
			array_push($id_order_state, $info);
		}
		else if($as == 'invoice')
		{
			array_push($invoice , $info);
		}
		else if($as == 'send_email')
		{
			array_push($send_email , $info);
		}
		else if($as == 'module_name')
		{
			array_push($module_name	 ,addslashes($info));
		}
		else if($as == 'color')
		{
			array_push($color , addslashes($info));
		}
		else if($as == 'unremovable')
		{
			array_push($unremovable , $info);
		}
		else if($as == 'hidden')
		{
			 array_push($hidden ,$info);
		}
		else if($as == 'logable')
		{
			array_push($logable ,$info);
		}
		else if($as == 'delivery')
		{
			array_push($delivery ,$info);
		}
		else if($as == 'shipped')
		{
			 array_push($shipped , $info);
		}
		else if($as == 'paid')
		{
			array_push($paid  , $info);
		}
		else if($as == 'pdf_invoice')
		{
			array_push($pdf_invoice ,$info);
		}
		else if($as == 'pdf_delivery')
		{
			array_push($pdf_delivery ,$info);
		}
		else if($as == 'deleted')
		{
			array_push($deleted ,$info);
		}
		
	
	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();


for($i = 0 ; $i <= (sizeof($arr)/47)-1 ; $i++)//AllData/columnsPerData
{
	//$selectquery = "SELECT *  FROM glog_order_state WHERE id_order_state =".$id_order_state[$i];
	//$result = mysql_query($selectquery,$conn);
	//$numrows = mysql_num_rows($result);
	
	
	
	//echo "<h1>".mysql_errno($conn) . ": " . mysql_error($conn) . "\n</h1>";

	
	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}
	//echo $id_order_state[$i].'- Numrrows = '.$numrows.'<br>';
	
			
	
		
			//echo 'replaced into '.$id_order_state[$i] . '<br>';
			mysql_query("REPLACE INTO glogdb_clone.glog_order_state(id_order_state,invoice,send_email,module_name,color,unremovable,hidden,logable,delivery,shipped,paid,pdf_invoice,pdf_delivery,deleted)VALUES(".$id_order_state[$i].",".$invoice[$i].",".$send_email[$i].",'".$module_name[$i]."','".$color[$i]."',".$unremovable[$i].",".$hidden[$i].",".$logable[$i].",".$delivery[$i].",".$shipped[$i].",".$paid[$i].",".$pdf_invoice[$i].",".$pdf_delivery[$i].",".$deleted[$i].");",$conn);
		
		$insertedIds .= $id_order_state[$i].",";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		
	
	


}


$id_order_states_IMPOLODED = implode(', ', $id_order_state);
if($id_order_states_IMPOLODED != NULL)
{
	$deletesql = "DELETE FROM glog_order_state WHERE id_order_state NOT IN (".$id_order_states_IMPOLODED.")";
}
else
{

	$deletesql = "DELETE FROM `glog_order_state`;";

}

mysql_query($deletesql);

$errorsString = "";
$email_message="";
if(sizeof($errors)>1)
{
	foreach($errors as $index=> $value)
	{
	$errorsString .= $value.",<br>";
	 }
}
else
{
	$email_message .="success";
}
$errors = array_unique($errors);




		$email_message .= '</br>Number of errors:'. sizeof($errors);
		$email_message .= "<br>Replace Into:".$insertedIds."<br>";
		$email_message .=  "Errors:".$errorsString."<br>";

		echo $email_message;

		

?>