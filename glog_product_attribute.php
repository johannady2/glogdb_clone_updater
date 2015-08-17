<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_product_attribute&glogdbcloneupdater-access=76ef0d45220fdee3ac883a0c7565e50c"),true);

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
$id_product_attribute = array();
$id_product = array();
$reference = array();
$supplier_reference = array();
$location = array();
$ean13 = array();
$upc = array();
$wholesale_price = array();
$price = array();
$ecotax = array();
$quantity = array();
$weight = array();
$unit_price_impact = array();
$default_on = array();
$minimal_quantity = array();
$available_date = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_product_attribute')
		{
			array_push($id_product_attribute, $info);
		}
		else if($as == 'id_product')
		{
			array_push($id_product, $info);
		}
		else if($as == 'reference')
		{
			array_push($reference, addslashes($info));
		}
		else if($as == 'supplier_reference')
		{
			array_push($supplier_reference, addslashes($info));
		}
		else if($as == 'location')
		{
			array_push($location, addslashes($info));
		}
		else if($as == 'ean13')
		{
			array_push($ean13, addslashes($info));
		}
		else if($as == 'upc')
		{
			array_push($upc, addslashes($info));
		}
		else if($as == 'wholesale_price')
		{
			array_push($wholesale_price, $info);
		}
		else if($as == 'price')
		{
			array_push($price, $info);
		}
		else if($as == 'ecotax')
		{
			array_push($ecotax, $info);
		}
		else if($as == 'weight')
		{
			array_push($weight, $info);
		}
		else if($as == 'unit_price_impact')
		{
			array_push($unit_price_impact, $info);
		}
		else if($as == 'default_on')
		{
			array_push($default_on, $info);
		}
		else if($as == 'minimal_quantity')
		{
			array_push($minimal_quantity, $info);
		}
		else if($as == 'available_date')
		{
			array_push($available_date, addslashes($info));
		}
		
	
	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();


for($i = 0 ; $i <= (sizeof($arr)/16)-1 ; $i++)//AllData/columnsPerData
{

	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}
	//echo $id_product[$i].'- Numrrows = '.$numrows.'<br>';
	 
			
	
		
			//echo 'replaced into '.$id_product_attribute[$i] . '<br>';
			mysql_query("REPLACE INTO glogdb_clone.glog_product_attribute (id_product_attribute,id_product,reference,supplier_reference,location,ean13,upc,wholesale_price,price,ecotax,quantity,weight,unit_price_impact,default_on,minimal_quantity,available_date)VALUES(".$id_product_attribute[$i].",".$id_product[$i].",'".$reference[$i]."','".$supplier_reference[$i]."','".$location[$i]."','".$ean13[$i]."','".$upc[$i]."',".$wholesale_price[$i].",".$price[$i].",".$ecotax[$i].",".$quantity[$i].",".$weight[$i].",".$unit_price_impact[$i].",".$default_on[$i].",".$minimal_quantity[$i].",'".$available_date[$i]."');",$conn);
		
		$insertedIds .= $id_product_attribute[$i].",";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		
	
	


}


$id_product_attributes_IMPOLODED = implode(', ', $id_product_attribute);
if($id_product_attributes_IMPOLODED != NULL)
{
	$deletesql = "DELETE FROM glog_product_attribute WHERE id_product_attribute NOT IN (".$id_product_attributes_IMPOLODED.")";
}
else
{

	$deletesql = "DELETE FROM `glog_product_attribute`;";

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