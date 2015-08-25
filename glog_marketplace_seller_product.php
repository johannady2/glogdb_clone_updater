<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_marketplace_seller_product&glogdbcloneupdater-access=76ef0d45220fdee3ac883a0c7565e50c"),true);

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
$id_seller= array();
$price = array();
$quantity = array();
$product_name = array();
$id_category = array();
$short_description = array();
$description = array();
$active = array();
$ps_id_shop= array();
$id_shop = array();
//$condition = array();
$admin_assigned = array();
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
		else if($as == 'id_seller')
		{
			array_push($id_seller, $info);
		}
		else if($as == 'price')
		{
			array_push($price, $info);
		}
		else if($as == 'quantity')
		{
			array_push($quantity, $info);
		}
		else if($as == 'product_name')
		{
			array_push($product_name, addslashes($info));
		}
		else if($as == 'id_category')
		{
			array_push($id_category, $info);
		}
		else if($as == 'short_description')
		{
			array_push($short_description, addslashes($info));
		}
		else if($as == 'description')
		{
			array_push($description, addslashes($info));
		}
		else if($as == 'active')
		{
			array_push($active, $info);
		}
		else if($as == 'ps_id_shop')
		{
			array_push($ps_id_shop, $info);
		}
		else if($as == 'id_shop')
		{
			array_push($id_shop, $info);
		}
		//else if($as == 'condition')
		//{
		//	array_push($condition, addslashes($info));
		//}
		else if($as == 'admin_assigned')
		{
			array_push($admin_assigned, $info);
		}
		else if($as == 'date_add')
		{
			array_push($date_add, addslashes($info));
		}
		else if($as == 'date_upd')
		{
			array_push($date_upd, addslashes($info));
		}

	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();


for($i = 0 ; $i <= (sizeof($arr)/15)-1 ; $i++)//AllData/columnsPerData
{

	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}
	//echo $id_product[$i].'- Numrrows = '.$numrows.'<br>';
	 
			
	
		
			//echo 'replaced into '.$id_attribute[$i] . '<br>';
			mysql_query("REPLACE INTO glogdb_clone.glog_marketplace_seller_product (id,id_seller,price,quantity,product_name,id_category,short_description,description,active,ps_id_shop,id_shop,admin_assigned,date_add,date_upd)VALUES(".$id[$i].",".$id_seller[$i].",".$price[$i].",".$quantity[$i].",'".$product_name[$i]."',".$id_category[$i].",'".$short_description[$i]."','".$description[$i]."',".$active[$i].",".$ps_id_shop[$i].",".$id_shop[$i].",".$admin_assigned[$i].",'".$date_add[$i]."','".$date_upd[$i]."');",$conn);
		
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
	$deletedsql = "deleted FROM glog_marketplace_seller_product WHERE id NOT IN (".$ids_IMPOLODED.")";
}
else
{

	$deletedsql = "deleted FROM `glog_marketplace_seller_product`;";

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