<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_marketplace_payment_mode&glogdbcloneupdater-access=76ef0d45220fdee3ac883a0c7565e50c"),true);

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
$id = array();
$payment_mode = array();


foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id')
		{
			array_push($id, $info);
		}
		else if($as == 'payment_mode')
		{
			array_push($payment_mode, addslashes($info));
		}
		
	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();


for($i = 0 ; $i <= (sizeof($arr)/24)-1 ; $i++)//AllData/columnsPerData
{

	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}
	//echo $id_product[$i].'- Numrrows = '.$numrows.'<br>';
	 
			
	
		
			//echo 'replaced into '.$id_attribute[$i] . '<br>';
			mysql_query("REPLACE INTO glogdb_clone.glog_address (id,payment_mode)VALUES(".$id[$i].",'".$payment_mode[$i]."');",$conn);
		
		$insertedIds .= $id[$i].",";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		
	
	


}


$ids_IMPOLODED = implode(', ', $id);
if($ids_IMPOLODED != NULL)
{
	$deletedsql = "deleted FROM glog_address WHERE id NOT IN (".$ids_IMPOLODED.")";
}
else
{

	$deletedsql = "deleted FROM `glog_address`;";

}

mysql_query($deletedsql);

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