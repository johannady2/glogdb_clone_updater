<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_order_detail&glogdbcloneupdater-access=76ef0d45220fdee3ac883a0c7565e50c"),true);

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
$id_order_detail = array();
$id_order =  array();
$id_order_invoice = array();
$id_warehouse = array();
$id_shop = array();
$product_id = array();
$product_attribute_id  = array();
$product_name  =  array();
$product_quantity = array();
$product_quantity_in_stock = array();
$product_quantity_refunded = array();
$product_quantity_return = array();
$product_quantity_reinjected = array();
$product_price = array();
$reduction_percent = array();
$reduction_amount = array();
$reduction_amount_tax_incl = array();
$reduction_amount_tax_excl = array();
$group_reduction = array();
$product_quantity_discount = array();
$product_ean13 = array();
$product_upc = array();
$product_reference = array();
$product_supplier_reference = array();
$product_weight = array();
$id_tax_rules_group = array();
$tax_computation_method = array();
$tax_name = array();
$tax_rate = array();
$ecotax = array();
$ecotax_tax_rate = array();
$discount_quantity_applied = array();
$download_hash = array();
$download_nb = array();
$download_deadline = array();
$total_price_tax_incl = array();
$total_price_tax_excl = array();
$unit_price_tax_incl = array();
$unit_price_tax_excl = array();
$total_shipping_price_tax_incl = array();
$total_shipping_price_tax_excl = array();
$purchase_supplier_price = array();
$original_product_price = array();
$original_product_price = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_order_detail')
		{
			array_push($id_order_detail, $info);
		}
		else if($as == 'id_order')
		{
			array_push($id_order , $info);
		}
		else if($as == 'id_order_invoice')
		{
			array_push($id_order_invoice ,$info);
		}
		else if($as == 'id_warehouse')
		{
			array_push($id_warehouse ,$info);
		}
		else if($as == 'id_shop')
		{
			array_push($id_shop ,$info);
		}
		else if($as == 'product_id')
		{
			 array_push($product_id ,$info);
		}
		else if($as == 'product_attribute_id')
		{
			array_push($product_attribute_id ,$info);
		}
		else if($as == 'product_name')
		{
			 array_push($product_name , addslashes($info));
		}
		else if($as == 'product_quantity')
		{
			array_push($product_quantity , $info);
		}
		else if($as == 'product_quantity_in_stock')
		{
			 array_push($product_quantity_in_stock ,$info);
		}
		else if($as == 'product_quantity_refunded')
		{
			array_push($product_quantity_refunded ,$info);
		}
		else if($as == 'product_quantity_return')
		{
			array_push($product_quantity_return ,$info);
		}
		else if($as == 'product_quantity_reinjected')
		{
			array_push($product_quantity_reinjected ,$info);
		}
		else if($as == 'product_price')
		{
			array_push($product_price , $info);
		}
		else if($as == 'reduction_percent')
		{
			array_push($reduction_percent ,$info);
		}
		else if($as == 'reduction_amount')
		{
			array_push($reduction_amount ,$info);
		}
		else if($as == 'reduction_amount_tax_incl')
		{
			array_push($reduction_amount_tax_incl ,$info);
		}
		else if($as == 'reduction_amount_tax_excl')
		{
			array_push($reduction_amount_tax_excl ,$info);
		}
		else if($as == 'group_reduction')
		{
			array_push($group_reduction ,$info);
		}
		else if($as == 'product_quantity_discount')
		{
			array_push($product_quantity_discount, $info);
		}
		else if($as == 'product_ean13')
		{
			array_push($product_ean13 , addslashes($info));
		}
		else if($as == 'product_upc')
		{
			array_push($product_upc , addslashes($info));
		}
		else if($as == 'product_reference')
		{
			array_push($product_reference, addslashes($info));
		}
		else if($as == 'product_supplier_reference')
		{
			array_push($product_supplier_reference ,addslashes($info));
		}
		else if($as == 'product_weight')
		{
			array_push($product_weight , $info);
		}
		else if($as == 'id_tax_rules_group')
		{
			array_push($id_tax_rules_group ,$info);
		}
		else if($as == 'tax_computation_method')
		{
			array_push($tax_computation_method ,$info);
		}
		else if($as == 'tax_name')
		{
			array_push($tax_name , addslashes($info));
		}
		else if($as == 'tax_rate')
		{
			array_push($tax_rate ,$info);
		}
		else if($as == 'ecotax')
		{
			array_push($ecotax ,$info);
		}
		else if($as == 'ecotax_tax_rate')
		{
			array_push($ecotax_tax_rate ,$info);
		}
		else if($as == 'discount_quantity_applied')
		{
			array_push($discount_quantity_applied ,$info);
		}
		else if($as == 'download_hash')
		{
			array_push($download_hash , addslashes($info));
		}
		else if($as == 'download_nb')
		{
			array_push($download_nb ,$info);
		}
		else if($as == 'download_deadline')
		{
			array_push($download_deadline , addslashes($info));
		}
		else if($as == 'total_price_tax_incl')
		{
			array_push($total_price_tax_incl ,$info);
		}
		else if($as == 'total_price_tax_excl')
		{
			array_push($total_price_tax_excl ,$info);
		}
		else if($as == 'unit_price_tax_incl')
		{
			array_push($unit_price_tax_incl ,$info);
		}
		else if($as == 'unit_price_tax_excl')
		{
			array_push($unit_price_tax_excl ,$info);
		}
		else if($as == 'total_shipping_price_tax_incl')
		{
			array_push($total_shipping_price_tax_incl, $info);
		}
		else if($as == 'total_shipping_price_tax_excl')
		{
			array_push($total_shipping_price_tax_excl ,$info);
		}
		else if($as == 'purchase_supplier_price')
		{
			array_push($purchase_supplier_price ,$info);
		}
		else if($as == 'original_product_price')
		{
			array_push($original_product_price ,$info);
		}
		else if($as == 'original_product_price')
		{
			array_push($original_product_price ,$info);
		}
	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();


for($i = 0 ; $i <= (sizeof($arr)/43)-1 ; $i++)//AllData/columnsPerData
{

	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}
	//echo $id_product[$i].'- Numrrows = '.$numrows.'<br>';
	 
			
	
		
			//echo 'replaced into '.$id_order_detail[$i] . '<br>';
			mysql_query("REPLACE INTO glogdb_clone.glog_order_detail(id_order_detail,id_order,id_order_invoice,id_warehouse,id_shop,product_id,product_attribute_id,product_name,product_quantity,product_quantity_in_stock,product_quantity_refunded,product_quantity_return,product_quantity_reinjected,product_price,reduction_percent,reduction_amount,reduction_amount_tax_incl,reduction_amount_tax_excl,group_reduction,product_quantity_discount,product_ean13,product_upc,product_reference,product_supplier_reference,product_weight,id_tax_rules_group,tax_computation_method,tax_name,tax_rate,ecotax,ecotax_tax_rate,discount_quantity_applied,download_hash,download_nb,download_deadline,total_price_tax_incl,total_price_tax_excl,unit_price_tax_incl,total_shipping_price_tax_incl,total_shipping_price_tax_excl,purchase_supplier_price,original_product_price)VALUES(".$id_order_detail[$i].",".$id_order[$i].",".$id_order_invoice[$i].",".$id_warehouse[$i].",".$id_shop[$i].",".$product_id[$i].",".$product_attribute_id[$i].",'".$product_name[$i]."',".$product_quantity[$i].",".$product_quantity_in_stock[$i].",".$product_quantity_refunded[$i].",".$product_quantity_return[$i].",".$product_quantity_reinjected[$i].",".$product_price[$i].",".$reduction_percent[$i].",".$reduction_amount[$i].",".$reduction_amount_tax_incl[$i].",".$reduction_amount_tax_excl[$i].",".$group_reduction[$i].",".$product_quantity_discount[$i].",'".$product_ean13[$i]."','".$product_upc[$i]."','".$product_reference[$i]."','".$product_supplier_reference[$i]."',".$product_weight[$i].",".$id_tax_rules_group[$i].",".$tax_computation_method[$i].",'".$tax_name[$i]."',".$tax_rate[$i].",".$ecotax[$i].",".$ecotax_tax_rate[$i].",".$discount_quantity_applied[$i].",'".$download_hash[$i]."',".$download_nb[$i].",'".$download_deadline[$i]."',".$total_price_tax_incl[$i].",".$total_price_tax_excl[$i].",".$unit_price_tax_incl[$i].",".$total_shipping_price_tax_incl[$i].",".$total_shipping_price_tax_excl[$i].",".$purchase_supplier_price[$i].",".$original_product_price[$i].");",$conn);
		
		$insertedIds .= $id_order_detail[$i].",";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		
	
	


}


$id_order_details_IMPOLODED = implode(', ', $id_order_detail);
if($id_order_details_IMPOLODED != NULL)
{
	$deletesql = "DELETE FROM glog_order_detail WHERE id_order_detail NOT IN (".$id_order_details_IMPOLODED.")";
}
else
{

	$deletesql = "DELETE FROM `glog_order_detail`;";

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