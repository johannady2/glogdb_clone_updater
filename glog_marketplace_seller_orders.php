<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_marketplace_seller_orders&glogdbcloneupdater-access=76ef0d45220fdee3ac883a0c7565e50c"),true);

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
$id_customer_seller = array();
$seller_shop = array();
$total_earn = array();
$total_admin_commission = array();
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
		else if($as == 'id_customer_seller')
		{
			array_push($id_customer_seller, $info);
		}
		else if($as =='seller_shop')
		{
			array_push($seller_shop, addslashes($info));
		}
		else if($as == 'total_earn')
		{
			array_push($total_earn, $info);
		}
		else if($as == 'total_admin_commission')
		{
			array_push($total_admin_commission, $info);
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


for($i = 0 ; $i <= (sizeof($arr)/24)-1 ; $i++)//AllData/columnsPerData
{

	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}
	//echo $id_product[$i].'- Numrrows = '.$numrows.'<br>';
	 
			
	
		
			//echo 'replaced into '.$id_attribute[$i] . '<br>';
			mysql_query("REPLACE INTO glogdb_clone.glog_marketplace_seller_orders (id,id_customer_seller,seller_shop,total_earn,total_admin_commission,date_add,date_upd)VALUES(".$id[$i].",".$id_customer_seller[$i].",'".$seller_shop[$i]."',".$total_earn[$i].",".$total_admin_commission[$i].",'".$date_add[$i]."','".$date_upd[$i]."');",$conn);
		
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
	$deletedsql = "deleted FROM glog_marketplace_seller_orders WHERE id NOT IN (".$ids_IMPOLODED.")";
}
else
{

	$deletedsql = "deleted FROM `glog_marketplace_seller_orders`;";

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