<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_cart_rule&glogdbcloneupdater-access=76ef0d45220fdee3ac883a0c7565e50c"),true);

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
$id_cart_rule = array();
$id_customer = array();
$date_from = array();
$date_to = array();
$description = array();
$quantity = array();
$quantity_per_user = array();
$priority = array();
$partial_use = array();
$code = array();
$minimum_amount =array();
$minimum_amount_tax = array();
$minimum_amount_currency = array();
$minimum_amount_shipping = array();
$country_restriction = array();
$carrier_restriction =array();
$group_restriction = array();
$product_restriction = array();
$shop_restriction = array();
$free_shipping = array();
$reduction_percent = array();
$reduction_amount = array();
$reduction_tax = array();
$reduction_currency = array();
$reduction_product = array();
$gift_product = array();
$gift_product_attribute = array();
$highlight = array();
$active = array();
$date_add= array();
$date_upd = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_cart_rule')
		{
			array_push($id_cart_rule, $info);
		}
		else if($as == 'id_customer')
		{
			array_push($id_customer , $info);
		}
		else if($as == 'date_from')
		{
			array_push($date_from , addslashes($info));
		}
		else if($as == 'date_to')
		{
			array_push($date_to ,addslashes($info));
		}
		else if($as == 'description')
		{
			array_push($description , addslashes($info));
		}
		else if($as == 'quantity')
		{
			array_push($quantity , $info);
		}
		else if($as == 'quantity_per_user')
		{
			array_push($quantity_per_user , $info);
		}
		else if($as == 'priority')
		{
			array_push($priority ,$info);
		}
		else if($as == 'partial_use')
		{
			array_push($partial_use ,$info);
		}
		else if($as == 'code')
		{
			array_push($code, addslashes($info));
		}
		else if($as == 'minimum_amount')
		{
			array_push($minimum_amount, $info);
		}
		else if($as == 'minimum_amount_tax')
		{
			array_push($minimum_amount_tax , $info);
		}
		else if($as == 'minimum_amount_currency')
		{
			array_push($minimum_amount_currency , $info);
		}
		else if($as == 'minimum_amount_shipping')
		{
			array_push($minimum_amount_shipping	 ,$info);
		}
		else if($as == 'country_restriction')
		{
			array_push($country_restriction ,$info);
		}
		else if($as == 'carrier_restriction')
		{
			array_push($carrier_restriction, $info);
		}
		else if($as == 'group_restriction')
		{
			array_push($group_restriction ,$info);
		}
		else if($as == 'product_restriction')
		{
			array_push($product_restriction ,$info);
		}
		else if($as == 'shop_restriction')
		{
			array_push($shop_restriction ,$info);
		}
		else if($as == 'free_shipping')
		{
			array_push($free_shipping ,$info);
		}
		else if($as == 'reduction_percent')
		{
			array_push($reduction_percent , $info);
		}
		else if($as == 'reduction_amount')
		{
			array_push($reduction_amount ,$info);
		}
		else if($as == 'reduction_tax')
		{
			array_push($reduction_tax ,$info);
		}
		else if($as == 'reduction_currency')
		{
			array_push($reduction_currency ,$info);
		}
		else if($as == 'reduction_product')
		{
			array_push($reduction_product ,$info);
		}
		else if($as == 'gift_product')
		{
			array_push($gift_product, $info);
		}
		else if($as == 'gift_product_attribute')
		{
			array_push($gift_product_attribute, $info);
		}
		else if($as == 'highlight')
		{
			array_push($highlight, $info);
		}
		else if($as == 'active')
		{
			array_push($active , $info);
		}
		else if($as == 'date_add')
		{
			array_push($date_add , addslashes($info));
		}
		else if($as == 'date_upd')
		{
			array_push($date_upd ,addslashes($info));
		}
	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();


for($i = 0 ; $i <= (sizeof($arr)/32)-1 ; $i++)//AllData/columnsPerData
{

	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}
	//echo $id_product[$i].'- Numrrows = '.$numrows.'<br>';
	 
			
	
		
			//echo 'replaced into '.$id_cart_rule[$i] . '<br>';
			mysql_query("REPLACE INTO glogdb_clone.glog_cart_rule (id_cart_rule,id_customer,date_from,date_to,description,quantity,quantity_per_user,priority,partial_use,code,minimum_amount,minimum_amount_tax,minimum_amount_currency,minimum_amount_shipping,country_restriction,carrier_restriction,group_restriction,product_restriction,shop_restriction,free_shipping,reduction_percent,reduction_amount,reduction_tax,reduction_currency,reduction_product,gift_product,gift_product_attribute,highlight,active,date_add,date_upd)VALUES(".$id_cart_rule[$i].",".$id_customer[$i].",'".$date_from[$i]."','".$date_to[$i]."','".$description[$i]."',".$quantity[$i].",".$quantity_per_user[$i].",".$priority[$i].",".$partial_use[$i].",'".$code[$i]."',".$minimum_amount[$i].",".$minimum_amount_tax[$i].",".$minimum_amount_currency[$i].",".$minimum_amount_shipping[$i].",".$country_restriction[$i].",".$carrier_restriction[$i].",".$group_restriction[$i].",".$product_restriction[$i].",".$shop_restriction[$i].",".$free_shipping[$i].",".$reduction_percent[$i].",".$reduction_amount[$i].",".$reduction_tax[$i].",".$reduction_currency[$i].",".$reduction_product[$i].",".$gift_product[$i].",".$gift_product_attribute[$i].",".$highlight[$i].",".$active[$i].",'".$date_add[$i]."','".$date_upd[$i]."');",$conn);
		
		$insertedIds .= $id_cart_rule[$i].",";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		
	
	


}


$id_cart_rules_IMPOLODED = implode(', ', $id_cart_rule);
if($id_cart_rules_IMPOLODED != NULL)
{
	$deletesql = "DELETE FROM glog_cart_rule WHERE id_cart_rule NOT IN (".$id_cart_rules_IMPOLODED.")";
}
else
{

	$deletesql = "DELETE FROM `glog_cart_rule`;";

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