<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_marketplace_shop&glogdbcloneupdater-access=76ef0d45220fdee3ac883a0c7565e50c"),true);

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
$shop_name = array();
$link_rewrite = array();
$id_customer = array();
$about_us = array();
$is_active = array();


foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id')
		{
			array_push($id, $info);
		}
		else if($as == 'shop_name')
		{
			array_push($shop_name, addslashes($info));
		}
		else if($as == 'link_rewrite')
		{
			array_push($link_rewrite, addslashes($info));
		}
		else if($as == 'id_customer')
		{
			array_push($id_customer, $info);
		}
		else if($as == 'about_us')
		{
			array_push($about_us, addslashes($info));
		}
		else if($as == 'is_active')
		{
			array_push($is_active, $info);
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
			mysql_query("REPLACE INTO glogdb_clone.glog_marketplace_shop (id,shop_name,link_rewrite,id_customer,about_us,is_active)VALUES(".$id[$i].",'".$shop_name[$i]."','".$link_rewrite[$i]."',".$id_customer[$i].",'".$about_us[$i]."',".$is_active[$i].");",$conn);
		
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
	$deletedsql = "deleted FROM glog_marketplace_shop WHERE id NOT IN (".$ids_IMPOLODED.")";
}
else
{

	$deletedsql = "deleted FROM `glog_marketplace_shop`;";

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