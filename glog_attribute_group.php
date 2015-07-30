<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_attribute_group"),true);

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
$id_attribute_group = array();
$is_color_group = array();
$group_type = array();
$position = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_attribute_group')
		{
			array_push($id_attribute_group, $info);
		}
		else if($as == 'is_color_group')
		{
			array_push($is_color_group, $info);
		}
		else if($as == 'group_type')
		{
			array_push($group_type, addslashes($info));
		}
		else if($as == 'position')
		{
			array_push($position, $info);
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
			mysql_query("REPLACE INTO glogdb_clone.glog_attribute_group (id_attribute_group,is_color_group,group_type,position)VALUES(".$id_attribute_group[$i].",".$is_color_group[$i].",'".$group_type[$i]."',".$position[$i].");",$conn);
		
		$insertedIds .= $id_attribute_group[$i].",";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		
	
	


}


$id_attribute_groups_IMPOLODED = implode(', ', $id_attribute_group);
if($id_attribute_groups_IMPOLODED != NULL)
{
	$deletesql = "DELETE FROM glog_attribute WHERE id_attribute_group NOT IN (".$id_attribute_groups_IMPOLODED.")";
}
else
{

	$deletesql = "DELETE FROM `glog_attribute_group`;";

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