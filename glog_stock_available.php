<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_stock_available"),true);

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
$id_stock_available = array();
$id_product = array();
$id_product_attribute = array();
$id_shop = array();
$id_shop_group = array();
$quantity = array();
$depends_on_stock = array();
$out_of_stock = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_stock_available')
		{
			array_push($id_stock_available, $info);
		}
		else if($as == 'id_product')
		{
			array_push($id_product , $info);
		}
		else if($as == 'id_product_attribute')
		{
			array_push($id_product_attribute , $info);
		}
		else if($as == 'id_shop')
		{
			array_push($id_shop , $info);
		}
		else if($as == 'id_shop_group')
		{
			array_push($id_shop_group , $info);
		}
		else if($as == 'quantity')
		{
			array_push($quantity , $info);
		}
		else if($as == 'depends_on_stock')
		{
			array_push($depends_on_stock , $info);
		}
		else if($as == 'out_of_stock')
		{
			array_push($out_of_stock , $info);
		}
	
	
	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();


for($i = 0 ; $i <= (sizeof($arr)/11)-1 ; $i++)//AllData/columnsPerData
{

	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}
	//echo $id_product[$i].'- Numrrows = '.$numrows.'<br>';
	 
			
	
		
			//echo 'replaced into '.$id_stock_available[$i] . '<br>';
mysql_query("REPLACE INTO glogdb_clone.glog_stock_available (id_stock_available,id_product,id_product_attribute,id_shop,id_shop_group,quantity,depends_on_stock,out_of_stock)VALUES(".$id_stock_available[$i].",".$id_product[$i].",".$id_product_attribute[$i].",".$id_shop[$i].",".$id_shop_group[$i].",".$quantity[$i].",".$depends_on_stock[$i].",".$out_of_stock[$i].");",$conn);
		
		$insertedIds .= $id_stock_available[$i].",";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		
	
	


}


$id_stock_availables_IMPOLODED = implode(', ', $id_stock_available);
if($id_stock_availables_IMPOLODED != NULL)
{
	$deletesql = "DELETE FROM glog_stock_available WHERE id_stock_available NOT IN (".$id_stock_availables_IMPOLODED.")";
}
else
{

	$deletesql = "DELETE FROM `glog_stock_available`;";

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