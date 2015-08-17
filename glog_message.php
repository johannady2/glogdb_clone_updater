<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_message&glogdbcloneupdater-access=76ef0d45220fdee3ac883a0c7565e50c"),true);

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
$id_message = array();
$id_cart = array();
$id_customer = array();
$id_employee = array();
$id_order = array();
$message = array();
$private = array();
$date_add =array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_message')
		{
			array_push($id_message, $info);
		}
		else if($as == 'id_cart')
		{
			array_push($id_cart , $info);
		}
		else if($as == 'id_customer')
		{
			array_push($id_customer , $info);
		}
		else if($as == 'id_employee')
		{
			array_push($id_employee , $info);
		}
		else if($as == 'id_order')
		{
			array_push($id_order , $info);
		}
		else if($as == 'message')
		{
			array_push($message , addslashes($info));
		}
		else if($as == 'private')
		{
			array_push($private ,$info);
		}
		else if($as == 'date_add')
		{
			array_push($date_add , $info);
		}
	
	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();


for($i = 0 ; $i <= (sizeof($arr)/8)-1 ; $i++)//AllData/columnsPerData
{

	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}
	//echo $id_product[$i].'- Numrrows = '.$numrows.'<br>';
	 
			
	
		
			//echo 'replaced into '.$id_message[$i] . '<br>';
			mysql_query("REPLACE INTO glogdb_clone.glog_message (id_message,id_cart,id_customer,id_employee,id_order,message,private,date_add)VALUES(".$id_message[$i].",".$id_cart[$i].",".$id_customer[$i].",".$id_employee[$i].",".$id_order[$i].",'".$message[$i]."',".$private[$i].",'".$date_add[$i]."');",$conn);
		
		$insertedIds .= $id_message[$i].",";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		
	
	


}


$id_messages_IMPOLODED = implode(', ', $id_message);
if($id_messages_IMPOLODED != NULL)
{
	$deletesql = "DELETE FROM glog_message WHERE id_message NOT IN (".$id_messages_IMPOLODED.")";
}
else
{

	$deletesql = "DELETE FROM `glog_message`;";

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