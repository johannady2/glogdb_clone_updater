<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_supplier_lang"),true);

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
$id_supplier = array();
$id_lang = array();
$description = array();
$meta_title = array();
$meta_keywords = array();
$meta_description = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_supplier')
		{
			array_push($id_supplier, intval($info));
		}
		else if($as == 'id_lang')
		{
			array_push($id_lang, $info);
		}
		else if($as == 'description')
		{
			array_push($description, addslashes($info));
		}
		else if($as == 'meta_title')
		{
			array_push($meta_title, addslashes($info));
		}
		else if($as == 'meta_keywords')
		{
			array_push($meta_keywords, addslashes($info));
		}
		else if($as == 'meta_description')
		{
			array_push($meta_description, addslashes($info));
		}

		
	
	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();

$deletesql = "DELETE FROM glog_supplier_lang WHERE (id_supplier,id_lang) NOT IN (";
for($i = 0 ; $i <= (sizeof($arr)/6)-1 ; $i++)//AllData/columnsPerData
{


	
	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}

			
	
		
		//echo 'replaced into '.$id_product[$i] . '-' . $id_shop[$i] .'-'.$id_lang[$i].'<br>';
		mysql_query("REPLACE INTO glogdb_clone.glog_supplier_lang(id_supplier,id_lang,description,meta_title,meta_keywords,meta_description)VALUES(".$id_supplier[$i].",".$id_lang[$i].",'".$description[$i]."','".$meta_title[$i]."','".$meta_keywords[$i]."','".$meta_description[$i]."');",$conn);
		
		$insertedIds .= '['.$id_supplier[$i].'-'.$id_lang[$i].'],';
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		



$deletesql .= "(".$id_supplier[$i].",".$id_lang[$i]."),";//composite primary key (key1,key2,key3),
}
$deletesql = rtrim($deletesql, ',');
$deletesql .= ");";

if($id_supplier == NULL )
{
	$deletesql = "DELETE FROM `glog_supplier_lang`;";
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