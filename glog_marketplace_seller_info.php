<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_marketplace_seller_info&glogdbcloneupdater-access=76ef0d45220fdee3ac883a0c7565e50c"),true);

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
$business_email = array();
$seller_name = array();
$shop_name = array();
$phone = array();
$fax = array();
$address = array();
$about_shop = array();
$facebook_id = array();
$twitter_id = array();
$active = array();
$date_add = array();
$date_upd = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id')
		{
			array_push($id, $info);
		}
		else if($as == 'business_email')
		{
			array_push($business_email, addslashes($info));
		}
		else if($as == 'seller_name')
		{
			array_push($seller_name , addslashes($info));
		}
		else if($as == 'shop_name')
		{
			array_push($shop_name, addslashes($info));
		}
		else if($as =='phone')
		{
			array_push($phone, addslashes($info));
		}
		else if($as == 'fax')
		{
			array_push($fax , addslashes($info));
		}
		else if($as == 'address')
		{
			array_push($address, addslashes($info));
		}
		else if($as == 'about_shop')
		{
			array_push($about_shop, addslashes($info));
		}
		else if($as == 'facebook_id')
		{
			array_push($facebook_id, addslashes($info));
		}
		else if($as == 'twitter_id')
		{
			array_push($twitter_id, addslashes($info));
		}
		else if($as == 'active')
		{
			array_push($active, $info);
		}
		else if($as == 'date_add')
		{
			array_push($date_add, addslashes($info));
		}
		else if($as == 'date_upd')
		{
			array_push($date_upd , addslashes($info));
		}
			
	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();


for($i = 0 ; $i <= (sizeof($arr)/13)-1 ; $i++)//AllData/columnsPerData
{

	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}
	//echo $id_product[$i].'- Numrrows = '.$numrows.'<br>';
	 
			
	
		
			//echo 'replaced into '.$id_attribute[$i] . '<br>';
			mysql_query("REPLACE INTO glogdb_clone.glog_marketplace_seller_info (id,business_email,seller_name,shop_name,phone,fax,address,about_shop,facebook_id,twitter_id,active,date_add,date_upd)VALUES(".$id[$i].",'".$business_email[$i]."','".$seller_name[$i]."','".$shop_name[$i]."','".$phone[$i]."','".$fax[$i]."','".$address[$i]."','".$about_shop[$i]."','".$facebook_id[$i]."','".$twitter_id[$i]."',".$active[$i].",'".$date_add[$i]."','".$date_upd[$i]."');",$conn);
		
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
	$deletedsql = "deleted FROM glog_marketplace_seller_info WHERE id NOT IN (".$ids_IMPOLODED.")";
}
else
{

	$deletedsql = "deleted FROM `glog_marketplace_seller_info`;";

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