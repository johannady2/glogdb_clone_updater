<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_manufacturer"),true);

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
$id_manufacturer = array();
$name = array();
$active = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_manufacturer')
		{
			array_push($id_manufacturer, $info);
		}
		else if ($as == 'name')
		{
			array_push($name,addslashes($info));
		}
		else if($as == 'date_add')
		{
			array_push($date_add , addslashes($info));
		}
		else if($as == 'date_upd')
		{
			array_push($date_upd , addslashes($info));
		}
		else if($as == 'active')
		{
			array_push($active , $info);
		}

	
	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();


for($i = 0 ; $i <= (sizeof($arr)/3)-1 ; $i++)//AllData/columnsPerData
{

	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}
	//echo $id_product[$i].'- Numrrows = '.$numrows.'<br>';
	 
			
	
		
			//echo 'replaced into '.$id_manufacturer[$i] . '<br>';
			mysql_query("REPLACE INTO glogdb_clone.glog_manufacturer (id_manufacturer,name,date_add,date_upd,active)VALUES(".$id_manufacturer[$i].",'".$name[$i]."','".$date_add[$i]."','".$date_upd[$i]."','".$active[$i]."');",$conn);
		
		$insertedIds .= $id_manufacturer[$i].",";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		
	
	


}


$id_manufacturers_IMPOLODED = implode(', ', $id_manufacturer);
if($id_manufacturers_IMPOLODED != NULL)
{
	$deletesql = "DELETE FROM glog_manufacturer WHERE id_manufacturer NOT IN (".$id_manufacturers_IMPOLODED.")";
}
else
{

	$deletesql = "DELETE FROM `glog_manufacturer`;";

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