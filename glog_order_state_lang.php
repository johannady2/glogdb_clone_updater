<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_order_state_lang&glogdbcloneupdater-access=76ef0d45220fdee3ac883a0c7565e50c"),true);

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
$id_lang = array();
$name = array();
$template= array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_order_state')
		{
			array_push($id_order_state, intval($info));
		}
		else if($as == 'id_lang')
		{
			array_push($id_lang, $info);
		}
		else if($as == 'name')
		{
			array_push($name ,addslashes($info));
		}
		else if($as == 'template')
		{
			 array_push($template ,addslashes($info));
		}
	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();

$deletesql = "DELETE FROM glog_order_state_lang WHERE (id_order_state,id_lang) NOT IN (";
for($i = 0 ; $i <= (sizeof($arr)/4)-1 ; $i++)//AllData/columnsPerData
{


	
	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}

			
	
		
		//echo 'replaced into '.$id_product[$i] . '-' . $id_shop[$i] .'-'.$id_lang[$i].'<br>';
		mysql_query("REPLACE INTO glogdb_clone.glog_order_state_lang(id_order_state,id_lang,name,template)VALUES(".$id_order_state[$i].",".$id_lang[$i].",'".$name[$i]."','".$template[$i]."');",$conn);
		
		$insertedIds .= '['.$id_order_state[$i].'-'.$id_lang[$i].'],';
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		



$deletesql .= "(".$id_order_state[$i].",".$id_lang[$i]."),";//composite primary key (key1,key2,key3),
}
$deletesql = rtrim($deletesql, ',');
$deletesql .= ");";

if($id_order_state == NULL )
{
	$deletesql = "DELETE FROM `glog_order_state_lang`;";
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