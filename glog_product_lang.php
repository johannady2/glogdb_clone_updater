<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_product_lang"),true);

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
$id_product = array();
$id_shop = array();
$id_lang = array();
$description = array();
$description_short = array();
$link_rewrite = array();
$meta_description = array();
$meta_keywords = array();
$meta_title = array();
$name = array();
$available_now = array();
$available_later = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_product')
		{
			array_push($id_product, intval($info));
		}
		else if($as == 'id_shop')
		{
			array_push($id_shop , intval($info));
		}
		else if($as == 'id_lang')
		{
			array_push($id_lang , intval($info));
		}
		else if($as == 'description')
		{
			array_push($description , addslashes($info));
		}
		else if($as == 'description_short')
		{
			array_push($description_short , addslashes($info));
		}
		else if($as == 'link_rewrite')
		{
			array_push($link_rewrite , addslashes($info));
		}
		else if($as == 'meta_description')
		{
			array_push($meta_description , addslashes($info));
		}
		else if($as == 'meta_keywords')
		{
			array_push($meta_keywords, addslashes($info));
		}
		else if($as == 'meta_title')
		{
			array_push($meta_title, addslashes($info));
		}
		else if($as == 'name')
		{
			array_push($name, addslashes($info));
		}
		else if($as == 'available_now')
		{
			array_push($available_now, addslashes($info));
		}
		else if($as == 'available_later')
		{
			array_push($available_later, addslashes($info));
		}
		
	
	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();

$deletesql = "DELETE FROM glog_product_lang WHERE (id_product,id_shop,id_lang) NOT IN (";
for($i = 0 ; $i <= (sizeof($arr)/12)-1 ; $i++)//AllData/columnsPerData
{


	
	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}

			
	
		
		//echo 'replaced into '.$id_product[$i] . '-' . $id_shop[$i] .'-'.$id_lang[$i].'<br>';
		mysql_query("REPLACE INTO glogdb_clone.glog_product_lang(id_product,id_shop,id_lang,description,description_short,link_rewrite,meta_description,meta_keywords,meta_title,name,available_now,available_later)VALUES(".$id_product[$i].",".$id_shop[$i].",".$id_lang[$i].",'".$description[$i]."','".$description_short[$i]."','".$link_rewrite[$i]."','".$meta_description[$i]."','".$meta_keywords[$i]."','".$meta_title[$i]."','".$name[$i]."','".$available_now[$i]."','".$available_later[$i]."');",$conn);
		
		$insertedIds .= '['.$id_product[$i] . '-' . $id_shop[$i] .'-'.$id_lang[$i]."],";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		



$deletesql .= "(".$id_product[$i].",".$id_shop[$i].",".$id_lang[$i]."),";
}
$deletesql = rtrim($deletesql, ',');
$deletesql .= ");";

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