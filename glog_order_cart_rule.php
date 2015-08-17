<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_order_cart_rule&glogdbcloneupdater-access=76ef0d45220fdee3ac883a0c7565e50c"),true);

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
$id_order_cart_rule = array();
$id_order = array();
$id_cart_rule = array();
$id_order_invoice = array();
$name = array();
//$value = array();
$value_tax_excl = array();
$free_shipping = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_order_cart_rule')
		{
			array_push($id_order_cart_rule, intval($info));
		}
		else if($as == 'id_order')
		{
			array_push($id_order , $info);
		}
		else if($as == 'id_cart_rule')
		{
			array_push($id_cart_rule , $info);
		}
		else if($as == 'id_order_invoice')
		{
			array_push($id_order_invoice , $info);
		}
		else if($as == 'name')
		{
			array_push($name , addslashes($info));
		}
		/*else if($as == 'value')
		{
			array_push($value , $info);
		}*/
		else if($as == 'value_tax_excl')
		{
			array_push($value_tax_excl , $info);
		}
		else if($as == 'free_shipping')
		{
			array_push($free_shipping , $info);
		}
		
	
	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();


for($i = 0 ; $i <= (sizeof($arr)/8)-1 ; $i++)//AllData/columnsPerData
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
			mysql_query("REPLACE INTO glogdb_clone.glog_order_cart_rule(id_order_cart_rule,id_order,id_cart_rule,id_order_invoice,name,value_tax_excl,free_shipping)VALUES(".$id_order_cart_rule[$i].",".$id_order[$i].",".$id_cart_rule[$i].",".$id_order_invoice[$i].",'".$name[$i]."',".$value_tax_excl[$i].",".$free_shipping[$i].");",$conn);
		
		$insertedIds .= $id_order_cart_rule[$i].",";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		
	
	


}


$id_order_cart_rules_IMPOLODED = implode(', ', $id_order_cart_rule);
if($id_order_cart_rules_IMPOLODED != NULL)
{
	$deletesql = "DELETE FROM glog_order_cart_rule WHERE id_order_cart_rule NOT IN (".$id_order_cart_rules_IMPOLODED.")";
}
else
{

	$deletesql = "DELETE FROM `glog_order_cart_rule`;";

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