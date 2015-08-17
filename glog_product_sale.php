<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_product_sale&glogdbcloneupdater-access=76ef0d45220fdee3ac883a0c7565e50c"),true);

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
$quantity = array();
$sale_nbr = array();
$date_upd = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_product')
		{
			array_push($id_product, $info);
		}
		else if($as == 'quantity')
		{
			array_push($quantity, $info);
		}
		else if($as == 'sale_nbr')
		{
			array_push($sale_nbr, $info);
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


for($i = 0 ; $i <= (sizeof($arr)/4)-1 ; $i++)//AllData/columnsPerData
{

	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}
	//echo $id_product[$i].'- Numrrows = '.$numrows.'<br>';
	
			
	
		
			//echo 'replaced into '.$id_product[$i] . '<br>';
			mysql_query("REPLACE INTO glogdb_clone.glog_product_sale (id_product,quantity,sale_nbr,date_upd)VALUES(".$id_product[$i].",".$quantity[$i].",".$sale_nbr[$i].",'".$date_upd[$i]."');",$conn);
		
		$insertedIds .= $id_product[$i].",";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		
	
	


}


$id_products_IMPOLODED = implode(', ', $id_product);
if($id_products_IMPOLODED != NULL)
{
	$deletesql = "DELETE FROM glog_product_sale WHERE id_product NOT IN (".$id_products_IMPOLODED.")";
}
else
{

	$deletesql = "DELETE FROM `glog_product_sale`;";

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