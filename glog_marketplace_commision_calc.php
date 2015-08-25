<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_marketplace_commision_calc&glogdbcloneupdater-access=76ef0d45220fdee3ac883a0c7565e50c"),true);

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
$id_seller_order = array();
$product_id = array();
$customer_id = array();
$customer_name = array();
$product_name = array();
$price = array();
$quantity = array();
$commision = array();
$id_order = array();
$date_add = array();


foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id')
		{
			array_push($id, $info);
		}
		else if($as = 'id_seller_order')
		{
			array_push($id_seller_order, $info);
		}
		else if($as == 'product_id')
		{
			array_push($product_id, $info);
		}
		else if($as == 'customer_id')
		{
			array_push($customer_id , $info);
		}
		else if($as == 'customer_name')
		{
			array_push($customer_name , addslashes($customer_name));
		}
		else if($as == 'product_name')
		{
			array_push($product_name, addslashes($info));
		}
		else if($as == 'price')
		{
			array_push($price,$info);
		}
		else if($as == 'quantity')
		{
			array_push($quantity, $info);
		}
		else if($as == 'commision')
		{
			array_push($commision, $info);
		}
		else if($as == 'id_order')
		{
			array_push($id_order,$info);
		}
		else if($sd == 'date_add')
		{
			array_push($date_add,addslashes($info));
		}
	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();


for($i = 0 ; $i <= (sizeof($arr)/12)-1 ; $i++)//AllData/columnsPerData
{

	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}
	//echo $id_product[$i].'- Numrrows = '.$numrows.'<br>';
	 
			
	
		
			//echo 'replaced into '.$id_attribute[$i] . '<br>';
			mysql_query("REPLACE INTO glogdb_clone.glog_marketplace_commision_calc (id,id_seller_order,product_id,customer_id,customer_name,product_name,price,quantity,commision,id_order,date_add)VALUES(".$id[$i].",".$id_seller_order[$i].",".$product_id[$i].",".$customer_id[$id].",'".$customer_name[$i]."','".$product_name[$i]."',".$price[$i].",".$quantity[$i].",".$commision[$i].",".$id_order[$i].",'".$date_add[$i]."');",$conn);
		
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
	$deletedsql = "deleted FROM glog_marketplace_commision_calc WHERE id NOT IN (".$ids_IMPOLODED.")";
}
else
{

	$deletedsql = "deleted FROM `glog_marketplace_commision_calc`;";

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