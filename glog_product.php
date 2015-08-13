<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_product"),true);

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
$id_supplier = array();
$id_manufacturer = array();
$id_category_default = array();
$id_shop_default = array();
$id_tax_rules_group = array();
$on_sale = array();
$online_only = array();
$ean13 = array();
$upc = array();
$ecotax = array();
$quantity = array();
$minimal_quantity = array();
$price = array();
$wholesale_price = array();
$unity = array();
$unit_price_ratio = array();
$additional_shipping_cost = array();
$reference = array();
$supplier_reference = array();
$location = array();
$width = array();
$height = array();
$depth = array();
$weight = array();
$out_of_stock = array();
$quantity_discount = array();
$customizable = array();
$uploadable_files = array();
$text_fields = array();
$active = array();
$redirect_type =array();
$id_product_redirected = array();
$available_for_order = array();
$available_date = array();
//$condition = array();
$show_price = array();
$indexed = array();
$visibility = array();
$cache_is_pack = array();
$cache_has_attachments = array();
$is_virtual = array();
$cache_default_attribute = array();
$date_add = array();
$date_upd = array();
$advanced_stock_management = array();
$pack_stock_type = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_product')
		{
			array_push($id_product, intval($info));
		}
		else if($as == 'id_supplier')
		{
			
			array_push($id_supplier, intval($info));
		}
		else if($as == 'id_manufacturer')
		{
			
			array_push($id_manufacturer, intval($info));
		}
		else if($as == 'id_category_default')
		{
			
			array_push($id_category_default, intval($info));
		}
		else if($as == 'id_shop_default')
		{
			
			array_push($id_shop_default, intval($info));
		}
		else if($as == 'id_tax_rules_group')
		{
			array_push($id_tax_rules_group, intval($info));
		}
		else if($as == 'on_sale')
		{
			array_push($on_sale, intval($info));
		}
		else if($as == 'online_only')
		{
			array_push($online_only, intval($info));
		}
		else if($as == 'ean13')
		{
			array_push($ean13, addslashes($info));
		}
		else if($as == 'upc')
		{
			array_push($upc, addslashes($info));
		}
		else if($as == 'ecotax')
		{
			array_push($ecotax, $info);
		}
		else if($as == 'quantity')
		{
			array_push($quantity, $info);
		}
		else if($as == 'minimal_quantity')
		{
			array_push($minimal_quantity, $info);
		}
		else if($as == 'price')
		{
			array_push($price, $info);
		}
		else if($as == 'wholesale_price')
		{
			array_push($wholesale_price, $info);
		}
		else if($as == 'unity')
		{
			array_push($unity, addslashes($info));
		}
		else if($as == 'unit_price_ratio')
		{
			array_push($unit_price_ratio, $info);
		}
		else if($as == 'additional_shipping_cost')
		{
			array_push($additional_shipping_cost, $info);
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
			array_push($location , addslashes($info));
		}
		else if($as == 'width')
		{
			array_push($width , $info);
		}
		else if($as == 'height')
		{
			array_push($height , $info);
		}
		else if($as == 'depth')
		{
			array_push($depth , $info);
		}
		else if($as == 'weight')
		{
			array_push($weight , $info);
		}
		else if($as == 'out_of_stock')
		{
			array_push($out_of_stock , $info);
		}
		else if($as == 'quantity_discount')
		{
			array_push($quantity_discount , $info);
		}
		else if($as == 'customizable')
		{
			array_push($customizable , $info);
		}
		else if($as == 'uploadable_files')
		{
			array_push($uploadable_files , $info);
		}
		else if($as == 'text_fields')
		{
			array_push($text_fields , $info);
		}
		else if($as == 'active')
		{
			array_push($active , $info);
		}
		else if($as == 'redirect_type')
		{
			array_push($redirect_type , $info);
		}
		else if($as == 'id_product_redirected')
		{
			array_push($id_product_redirected , $info);
		}
		else if($as == 'available_for_order')
		{
			array_push($available_for_order , $info);
		}
		else if($as == 'available_date')
		{
			array_push($available_date , $info);
		}
		else if($as == 'show_price')
		{
			array_push($show_price , $info);
		}
		else if($as == 'indexed')
		{
			array_push($indexed , $info);
		}
		else if($as == 'visibility')
		{
			array_push($visibility , $info);
		}
		else if($as == 'cache_is_pack')
		{
			array_push($cache_is_pack , $info);
		}
		else if($as == 'cache_has_attachments')
		{
			array_push($cache_has_attachments , $info);
		}
		else if($as == 'is_virtual')
		{
			array_push($is_virtual , $info);
		}
		else if($as == 'cache_default_attribute')
		{
			array_push($cache_default_attribute , $info);
		}
		else if($as == 'date_add')
		{
			array_push($date_add , $info);
		}
		else if($as == 'date_upd')
		{
			array_push($date_upd , $info);
		}
		else if($as == 'advanced_stock_management')
		{
			array_push($advanced_stock_management , $info);
		}
		else if($as == 'pack_stock_type')
		{
			array_push($pack_stock_type , $info);
		}
		
		
	
	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();


for($i = 0 ; $i <= (sizeof($arr)/47)-1 ; $i++)//AllData/columnsPerData
{
	//$selectquery = "SELECT *  FROM glog_product WHERE id_product =".$id_product[$i];
	//$result = mysql_query($selectquery,$conn);
	//$numrows = mysql_num_rows($result);
	
	
	
	//echo "<h1>".mysql_errno($conn) . ": " . mysql_error($conn) . "\n</h1>";

	
	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}
	//echo $id_product[$i].'- Numrrows = '.$numrows.'<br>';
	
			
	
		
						//echo 'replaced into '.$id_product[$i] . '<br>';
			mysql_query("REPLACE INTO glogdb_clone.glog_product(id_product,id_supplier,id_manufacturer,id_category_default,id_shop_default,id_tax_rules_group,on_sale,online_only,ean13,upc,ecotax,quantity,minimal_quantity,price,wholesale_price,unity,unit_price_ratio,additional_shipping_cost,reference,supplier_reference,location,width,height,depth,weight,out_of_stock,quantity_discount,customizable,uploadable_files,text_fields,active,redirect_type,id_product_redirected,available_for_order,available_date,show_price,indexed,visibility,cache_is_pack,cache_has_attachments,is_virtual,cache_default_attribute,date_add,date_upd,advanced_stock_management,pack_stock_type)VALUES(".$id_product[$i].",".$id_supplier[$i].",".$id_manufacturer[$i].",".$id_category_default[$i].",".$id_shop_default[$i].",".$id_tax_rules_group[$i].",".$on_sale[$i].",".$online_only[$i].",'".$ean13[$i]."','".$upc[$i]."',".$ecotax[$i].",".$quantity[$i].",".$minimal_quantity[$i].",".$price[$i].",".$wholesale_price[$i].",'".$unity[$i]."',".$unit_price_ratio[$i].",".$additional_shipping_cost[$i].",'".$reference[$i]."','".$supplier_reference[$i]."','".$location[$i]."',".$width[$i].",".$height[$i].",".$depth[$i].",".$weight[$i].",".$out_of_stock[$i].",".$quantity_discount[$i].",".$customizable[$i].",".$uploadable_files[$i].",".$text_fields[$i].",".$active[$i].",'".$redirect_type[$i]."',".$id_product_redirected[$i].",".$available_for_order[$i].",".$available_date[$i].",".$show_price[$i].",".$indexed[$i].",'".$visibility[$i]."',".$cache_is_pack[$i].",".$cache_has_attachments[$i].",".$is_virtual[$i].",".$cache_default_attribute[$i].",'".$date_add[$i]."','".$date_upd[$i]."',".$advanced_stock_management[$i].",".$pack_stock_type[$i].");",$conn);
		
		
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
	$deletesql = "DELETE FROM glog_product WHERE id_product NOT IN (".$id_products_IMPOLODED.")";
}
else
{

	$deletesql = "DELETE FROM `glog_product`;";

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