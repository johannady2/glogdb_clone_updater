<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_marketplace_customer_query&glogdbcloneupdater-access=76ef0d45220fdee3ac883a0c7565e50c"),true);

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
$id_product = array();
$id_customer = array();
$id_seller = array();
$subject = array();
$description = array();
$customer_email = array();
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
		else if($as == 'id_product')
		{
			array_push($id_product, $info);
		}
		else if($as == 'id_customer')
		{
			array_push($id_customer, $info);
		}
		else if($as == 'id_seller')
		{
			array_push($id_seller, $info);
		}
		else if($as == 'subject')
		{
			array_push($subject, addslashes($info));
		}
		else if($as == 'description')
		{
			array_push($description , addslashes($info));
		}
		else if($as == 'customer_email')
		{
			array_push($customer_email, addslashes($info));
		}
		else if($as == 'active')
		{
			array_push($active, $info);
		}
		else if($as == 'date_add')
		{
			array_push($date_add, $info);
		}
		else if($as == 'date_upd')
		{
			array_push($date_upd, $info);
		}
	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();


for($i = 0 ; $i <= (sizeof($arr)/10)-1 ; $i++)//AllData/columnsPerData
{

	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}
	//echo $id_product[$i].'- Numrrows = '.$numrows.'<br>';
	 
			
	
		
			//echo 'replaced into '.$id_attribute[$i] . '<br>';
			mysql_query("REPLACE INTO glogdb_clone.glog_marketplace_customer_query (id,id_product,id_customer,id_seller,subject,description,customer_email,active,date_add,date_upd)VALUES(".$id[$i].",".$id_product[$i].",".$id_customer[$i].",".$id_seller[$i].",'".$subject[$i]."','".$description[$i]."','".$customer_email[$i]."',".$active[$i].",'".$date_add[$i]."','".$date_upd[$i]."');",$conn);
		
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
	$deletedsql = "deleted FROM glog_marketplace_customer_query WHERE id NOT IN (".$ids_IMPOLODED.")";
}
else
{

	$deletedsql = "deleted FROM `glog_marketplace_customer_query`;";

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