<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_state"),true);

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
$id_state = array();
$id_country = array();
$id_zone = array();
$name = array();
$iso_code = array();
$tax_behavior = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_state')
		{
			array_push($id_state, $info);
		}
		else if($as == 'id_country')
		{
			array_push($id_country ,$info);
		}
		else if($as == 'id_zone')
		{
			array_push($id_zone ,$info);
		}
		else if($as == 'name')
		{
			array_push($name , addslashes($info));
		}
		else if($as == 'iso_code')
		{
			 array_push($iso_code ,addslashes($info));
		}
		else if($as == 'tax_behavior')
		{
			array_push($tax_behavior , $info);
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
			mysql_query("REPLACE INTO glogdb_clone.glog_state (id_state,id_country,id_zone,name,iso_code,tax_behavior)VALUES(".$id_state[$i].",".$id_country[$i].",".$id_zone[$i].",'".$name[$i]."','".$iso_code[$i]."',".$tax_behavior[$i].");",$conn);
		
		$insertedIds .= $id_state[$i].",";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		
	
	


}


$id_states_IMPOLODED = implode(', ', $id_state);
if($id_states_IMPOLODED != NULL)
{
	$deletedsql = "deleted FROM glog_state WHERE id_state NOT IN (".$id_states_IMPOLODED.")";
}
else
{

	$deletedsql = "deleted FROM `glog_state`;";

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