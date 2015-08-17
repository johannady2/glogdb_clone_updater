<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_attribute&glogdbcloneupdater-access=76ef0d45220fdee3ac883a0c7565e50c"),true);

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
$id_attribute = array();
$id_attribute_group = array();
$color = array();
$position = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_attribute')
		{
			array_push($id_attribute, $info);
		}
		else if($as == 'id_attribute_group')
		{
			array_push($id_attribute_group, $info);
		}
		else if($as == 'color')
		{
			array_push($color, addslashes($info));
		}
		else if($as == 'position')
		{
			array_push($position , addslashes($info));
		}

	
	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();


for($i = 0 ; $i <= (sizeof($arr)/4)-1 ; $i++)//AllData/columnsPerData
{

	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}
	//echo $id_product[$i].'- Numrrows = '.$numrows.'<br>';
	 
			
	
		
			//echo 'replaced into '.$id_attribute[$i] . '<br>';
			mysql_query("REPLACE INTO glogdb_clone.glog_attribute (id_attribute,id_attribute_group,color,position)VALUES(".$id_attribute[$i].",".$id_attribute_group[$i].",'".$color[$i]."',".$position[$i].");",$conn);
		
		$insertedIds .= $id_attribute[$i].",";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		
	
	


}


$id_attributes_IMPOLODED = implode(', ', $id_attribute);
if($id_attributes_IMPOLODED != NULL)
{
	$deletesql = "DELETE FROM glog_attribute WHERE id_attribute NOT IN (".$id_attributes_IMPOLODED.")";
}
else
{

	$deletesql = "DELETE FROM `glog_attribute`;";

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