<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_orders&glogdbcloneupdater-access=76ef0d45220fdee3ac883a0c7565e50c"),true);

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
$id_order = array();
$reference = array();
$id_shop_group = array();
$id_shop = array();
$id_carrier = array();
$id_lang = array();
$id_customer = array();
$id_cart = array();
$id_currency = array();
$id_address_delivery = array();
$id_address_invoice = array();
$current_state = array();
$secure_key = array();
$payment = array();
$conversion_rate = array();
$module = array();
$recyclable = array();
$gift = array();
$gift_message = array();
$mobile_theme = array();
$shipping_number = array();
$total_discounts = array();
$total_discounts_tax_incl = array();
$total_discounts_tax_excl = array();
$total_paid = array();
$total_paid_tax_incl  = array();
$total_paid_tax_excl = array();
$total_paid_real = array();
$total_products = array();
$total_products_wt = array();
$total_shipping = array();
$total_shipping_tax_incl = array();
$total_shipping_tax_excl = array();
$carrier_tax_rate = array();
$total_wrapping = array();
$total_wrapping_tax_incl = array();
$total_wrapping_tax_excl = array();
$round_mode = array();
$invoice_number = array();
$delivery_number = array();
$round_mode = array(); 
$invoice_number = array();
$delivery_number = array();
$invoice_date = array();
$delivery_date = array();
$valid = array();
$date_add = array();
$date_upd = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_order')
		{
			array_push($id_order, $info);
		}
		else if($as == 'reference')
		{
			array_push($reference , addslashes($info));
		}
		else if($as == 'id_shop_group')
		{
			array_push($id_shop_group , $info);
		}
		else if($as == 'id_shop')
		{
			array_push($id_shop , $info);
		}
		else if($as == 'id_carrier')
		{
			array_push($id_carrier , $info);
		}
		else if($as == 'id_lang')
		{
			array_push($id_lang , $info);
		}
		else if($as == 'id_customer')
		{
			array_push($id_customer , $info);
		}
		else if($as == 'id_cart')
		{
			array_push($id_cart , $info);
		}
		else if($as == 'id_currency')
		{
			array_push($id_currency , $info);
		}
		else if($as == 'id_address_delivery')
		{
			array_push($id_address_delivery , $info);
		}
		else if($as == 'id_address_invoice')
		{
			array_push($id_address_invoice , $info);
		}
		else if($as == 'current_state')
		{
			array_push($current_state , $info);
		}
		else if($as == 'secure_key')
		{
			array_push($secure_key , addslashes($info));
		}
		else if($as == 'payment')
		{
			array_push($payment , addslashes($info));
		}
		else if($as == 'conversion_rate')
		{
			array_push($conversion_rate , $info);
		}
		else if($as == 'module')
		{
			array_push($module , addslashes($info));
		}
		else if($as == 'recyclable')
		{
			array_push($recyclable , $info);
		}
		else if($as == 'gift')
		{
			array_push($gift , $info);
		}
		else if($as == 'gift_message')
		{
			array_push($gift_message , addslashes($info));
		}
		else if($as== 'mobile_theme')
		{
			array_push($mobile_theme , $info);
		}
		else if($as == 'shipping_number')
		{
			array_push($shipping_number , addslashes($info));
			
		}
		else if($as == 'total_discounts')
		{
			array_push($total_discounts , $info);
		}
		else if($as == 'total_discounts_tax_incl')
		{
			 array_push($total_discounts_tax_incl , $info);
		}
		else if($as == 'total_discounts_tax_excl')
		{
			array_push($total_discounts_tax_excl , $info);
		}
		else if($as == 'total_paid')
		{
			array_push($total_paid , $info);
		}
		else if($as == 'total_paid_tax_incl')
		{
			array_push($total_paid_tax_incl , $info);
		}
		else if($as == 'total_paid_tax_excl')
		{
			array_push($total_paid_tax_excl , $info);
		}
		else if($as == 'total_paid_real')
		{
			array_push($total_paid_real , $info);
		}
		else if($as == 'total_products')
		{
			array_push($total_products, $info);
		}
		else if($as == 'total_products_wt')
		{
			array_push($total_products_wt , $info);
		}
		else if($as == 'total_shipping')
		{
			array_push($total_shipping , $info);
		}
		else if($as == 'total_shipping_tax_incl')
		{
			array_push($total_shipping_tax_incl , $info);
		}
		else if($as == 'total_shipping_tax_excl')
		{
			array_push($total_shipping_tax_excl , $info);
		}
		else if($as == 'carrier_tax_rate')
		{
			array_push($carrier_tax_rate , $info);
		}
		else if($as == 'total_wrapping')
		{
			array_push($total_wrapping , $info);
		}
		else if($as == 'total_wrapping_tax_incl')
		{
			array_push($total_wrapping_tax_incl ,$info);
		}
		else if($as == 'total_wrapping_tax_excl')
		{
			array_push($total_wrapping_tax_excl , $info);
		}
		else if($as == 'round_mode')
		{
			array_push($round_mode , $info);
		}
		else if($as == 'invoice_number')
		{
			array_push($invoice_number , $info);
		}
		else if($as == 'delivery_number')
		{
			array_push($delivery_number , $info);
		}
		else if($as == 'invoice_date')
		{
			array_push($invoice_date , addslashes($info));
		}
		else if($as == 'delivery_date')
		{
			array_push($delivery_date , addslashes($info));
		}
		else if($as == 'valid')
		{
			array_push($valid , $info);
		}
		else if($as == 'date_add')
		{
			array_push($date_add ,addslashes($info));
			
		}
		else if($as == 'date_upd')
		{
			array_push($date_upd , addslashes($info));
		}

	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();


for($i = 0 ; $i <= (sizeof($arr)/46)-1 ; $i++)//AllData/columnsPerData
{

	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}
	//echo $id_product[$i].'- Numrrows = '.$numrows.'<br>';
	 
			
	
	
		
					//echo 'replaced into '.$id_attribute[$i] . '<br>';
			mysql_query("REPLACE INTO glogdb_clone.glog_orders (id_order,reference,id_shop_group,id_shop,id_carrier,id_lang,id_customer,id_cart,id_currency,id_address_delivery,id_address_invoice,current_state,secure_key,payment,conversion_rate,module,recyclable,gift,gift_message,mobile_theme,shipping_number,total_discounts,total_discounts_tax_incl,total_discounts_tax_excl,total_paid,total_paid_tax_incl,total_paid_tax_excl,total_paid_real,total_products_wt,total_shipping,total_shipping_tax_incl,total_shipping_tax_excl,carrier_tax_rate,total_wrapping,total_wrapping_tax_incl,total_wrapping_tax_excl,round_mode,invoice_number,delivery_number,invoice_date,delivery_date,valid,date_add,date_upd)VALUES(".$id_order[$i].",'".$reference[$i]."',".$id_shop_group[$i].",".$id_shop[$i].",".$id_carrier[$i].",".$id_lang[$i].",".$id_customer[$i].",".$id_cart[$i].",".$id_currency[$i].",".$id_address_delivery[$i].",".$id_address_invoice[$i].",".$current_state[$i].",'".$secure_key[$i]."','".$payment[$i]."',".$conversion_rate[$i].",'".$module[$i]."',".$recyclable[$i].",".$gift[$i].",'".$gift_message[$i]."',".$mobile_theme[$i].",'".$shipping_number[$i]."',".$total_discounts[$i].",".$total_discounts_tax_incl[$i].",".$total_discounts_tax_excl[$i].",".$total_paid[$i].",".$total_paid_tax_incl[$i].",".$total_paid_tax_excl[$i].",".$total_paid_real[$i].",".$total_products_wt[$i].",".$total_shipping[$i].",".$total_shipping_tax_incl[$i].",".$total_shipping_tax_excl[$i].",".$carrier_tax_rate[$i].",".$total_wrapping[$i].",".$total_wrapping_tax_incl[$i].",".$total_wrapping_tax_excl[$i].",".$round_mode[$i].",".$invoice_number[$i].",".$delivery_number[$i].",'".$invoice_date[$i]."','".$delivery_date[$i]."',".$valid[$i].",'".$date_add[$i]."','".$date_upd[$i]."');",$conn);
		
		
		$insertedIds .= $id_order[$i].",";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		
	
	


}


$id_orders_IMPOLODED = implode(', ', $id_order);
if($id_orders_IMPOLODED != NULL)
{
	$deletedsql = "deleted FROM glog_orders WHERE id_order NOT IN (".$id_orders_IMPOLODED.")";
}
else
{

	$deletedsql = "deleted FROM `glog_orders`;";

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