<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_marketplace_seller_reviews&glogdbcloneupdater-access=76ef0d45220fdee3ac883a0c7565e50c"),true);

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
$id_review = array();
$id_seller = array();
$id_customer= array();
$customer_email = array();
$rating = array();
$review = array();
$active = array();
$date_add = array();


foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_review')
		{
			array_push($id_review, $info);
		}
		else if($as == 'id_seller')
		{
			array_push($id_seller, $info);
		}
		else if($as == 'id_customer')
		{
			array_push($id_customer, $info);
		}
		else if($as == 'customer_email')
		{
			array_push($customer_email, addslashes($info));
		}
		else if($as == 'rating')
		{
			array_push($rating, $info);
		}
		else if($as == 'review')
		{
			array_push($review, $info);
		}
		else if($as == 'active')
		{
			array_push($active, $info);
		}
		else if($as == 'date_add')
		{
			array_push($date_add, addslashes($info));
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
			mysql_query("REPLACE INTO glogdb_clone.glog_marketplace_seller_reviews (id_review,id_seller,id_customer,customer_email,rating,review,active,date_add)VALUES(".$id_review[$i].",".$id_seller[$i].",".$id_customer[$i].",'".$customer_email[$i]."',".$rating[$i].",".$review[$i].",".$active[$i].",'".$date_add[$i]."');",$conn);
		
		$insertedIds .= $id_review[$i].",";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		
	
	


}


$id_reviews_IMPOLODED = implode(', ', $id_review);
if($id_reviews_IMPOLODED != NULL)
{
	$deletedsql = "deleted FROM glog_marketplace_seller_reviews WHERE id_review NOT IN (".$id_reviews_IMPOLODED.")";
}
else
{

	$deletedsql = "deleted FROM `glog_marketplace_seller_reviews`;";

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