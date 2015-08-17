<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_address&glogdbcloneupdater-access=76ef0d45220fdee3ac883a0c7565e50c"),true);

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
$id_address = array();
$id_country = array();
$id_state = array();
$id_customer = array();
$id_manufacturer = array();
$id_supplier = array();
$id_warehouse = array();
$alias = array();
$company = array();
$lastname = array();
$firstname = array();
$address1 = array();
$address2 = array();
$postcode = array();
$city = array();
$other = array();
$phone = array();
$phone_mobile = array();
$vat_number = array();
$dni = array();
$date_add = array();
$date_upd = array();
$active = array();
$deleted = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_address')
		{
			array_push($id_address, $info);
		}
		else if($as == 'id_country')
		{
			array_push($id_country, $info);
		}
		else if($as == 'id_state')
		{
			array_push($id_state, $info);
		}
		else if($as == 'id_customer')
		{
			array_push($id_customer, $info);
		}
		else if($as == 'id_manufacturer')
		{
			array_push($id_manufacturer, $info);
		}
		else if($as == 'id_supplier')
		{
			array_push($id_supplier, $info);
		}
		else if($as == 'id_warehouse')
		{
			array_push($id_warehouse, $info);
		}
		else if($as == 'alias')
		{
			array_push($alias, addslashes($info));
		}
		else if($as == 'company')
		{
			array_push($company, addslashes($info));
		}
		else if($as == 'lastname')
		{
			array_push($lastname, addslashes($info));
		}
		else if($as == 'firstname')
		{
			array_push($firstname, addslashes($info));
		}
		else if($as == 'address1')
		{
			array_push($address1, addslashes($info));
		}
		else if($as == 'address2')
		{
			array_push($address2, addslashes($info));
		}
		else if($as == 'postcode')
		{
			array_push($postcode, addslashes($info));
		}
		else if($as == 'city')
		{
			array_push($city, addslashes($info));
		}
		else if($as == 'other')
		{
			array_push($other , addslashes($info));
		}
		else if($as == 'phone')
		{
			array_push($phone , addslashes($info));
		}
		else if($as == 'phone_mobile')
		{
			array_push($phone_mobile , addslashes($info));
		}
		else if($as == 'vat_number')
		{
			array_push($vat_number , addslashes($info));
		}
		else if($as == 'dni')
		{
			array_push($dni , addslashes($info));
		}
		else if($as == 'date_add')
		{
			array_push($date_add , addslashes($info));
		}
		else if($as == 'date_upd')
		{
			array_push($date_upd , addslashes($info));
		}
		else if($as == 'active')
		{
			array_push($active , $info);
		}
		else if($as == 'deleted')
		{
			array_push($deleted , $info);
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
			mysql_query("REPLACE INTO glogdb_clone.glog_address (id_address,id_country,id_state,id_customer,id_manufacturer,id_supplier,id_warehouse,alias,company,lastname,firstname,address1,address2,postcode,city,other,phone,phone_mobile,vat_number,dni,date_add,date_upd,active,deleted)VALUES(".$id_address[$i].",".$id_country[$i].",".$id_state[$i].",".$id_customer[$i].",".$id_manufacturer[$i].",".$id_supplier[$i].",".$id_warehouse[$i].",'".$alias[$i]."','".$company[$i]."','".$lastname[$i]."','".$firstname[$i]."','".$address1[$i]."','".$address2[$i]."','".$postcode[$i]."','".$city[$i]."','".$other[$i]."','".$phone[$i]."','".$phone_mobile[$i]."','".$vat_number[$i]."','".$dni[$i]."','".$date_add[$i]."','".$date_upd[$i]."',".$active[$i].",".$deleted[$i].");",$conn);
		
		$insertedIds .= $id_address[$i].",";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		
	
	


}


$id_addresss_IMPOLODED = implode(', ', $id_address);
if($id_addresss_IMPOLODED != NULL)
{
	$deletedsql = "deleted FROM glog_address WHERE id_address NOT IN (".$id_addresss_IMPOLODED.")";
}
else
{

	$deletedsql = "deleted FROM `glog_address`;";

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