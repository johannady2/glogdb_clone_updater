<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_customer&glogdbcloneupdater-access=76ef0d45220fdee3ac883a0c7565e50c"),true);

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
$id_customer = array();
$id_shop_group = array();
$id_shop = array();
$id_gender = array();
$id_default_group = array();
$id_lang = array();
$id_risk = array();
$company = array();
$siret = array();
$ape = array();
$firstname = array();
$lastname = array();
$email = array();
$passwd = array();
$last_passwd_gen = array();
$birthday = array();
$newsletter = array();
$ip_registration_newsletter = array();
$newsletter_date_add = array();
$optin = array();
$website = array();
$outstanding_allow_amount = array();
$show_public_prices  = array();
$max_payment_days = array();
$secure_key = array();
$note = array();
$active = array();
$is_guest = array();
$deleted = array();
$date_add = array();
$date_upd = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_customer')
		{
			array_push($id_customer, $info);
		}
		else if($as == 'id_shop_group')
		{
			array_push($id_shop_group,$info);
		}
		else if($as == 'id_shop')
		{
			array_push($id_shop , $info);
		}
		else if($as == 'id_gender')
		{
			array_push($id_gender , $info);
		}
		else if($as == 'id_default_group')
		{
			array_push($id_default_group , $info);
		}
		else if($as == 'id_lang')
		{
			array_push($id_lang , $info);
		}
		else if($as == 'id_risk')
		{
			array_push($id_risk , $info);
		}
		else if($as == 'company')
		{
			array_push($company , addslashes($info));
		}
		else if($as == 'siret')
		{
			array_push($siret , addslashes($info));
		}
		else if($as == 'ape')
		{
			array_push($ape , addslashes($info));
		}
		else if($as == 'firstname')
		{
			array_push($firstname , addslashes($info));
		}
		else if($as == 'lastname')
		{
			array_push($lastname , addslashes($info));
		}
		else if($as == 'email')
		{
			array_push($email , addslashes($info));
		}
		else if($as == 'passwd')
		{
			array_push($passwd , addslashes($info));
		}
		else if($as == 'last_passwd_gen')
		{
			array_push($last_passwd_gen , addslashes($info));
		}
		else if($as == 'birthday')
		{
			array_push($birthday , addslashes($info));
		}
		else if($as == 'newsletter')
		{
			array_push($newsletter , $info);
		}
		else if($as == 'ip_registration_newsletter')
		{
			array_push($ip_registration_newsletter , addslashes($info));
		}
		else if($as == 'newsletter_date_add')
		{
			array_push($newsletter_date_add , addslashes($info));
		}
		else if($as == 'optin')
		{
			
			array_push($optin , $info);
		}
		else if($as == 'website')
		{
			array_push($website , addslashes($info));
		}
		else if($as == 'outstanding_allow_amount')
		{
			array_push($outstanding_allow_amount, $info);
		}
		else if($as == 'show_public_prices')
		{
			array_push($show_public_prices , $info);
		}
		else if($as == 'max_payment_days')
		{
			array_push($max_payment_days , $info);
		}
		else if($as == 'secure_key')
		{
			array_push($secure_key , addslashes($info));
		}
		else if($as == 'note')
		{
			array_push($note , addslashes($info));
		}
		else if($as == 'active')
		{
			array_push($active , $info);
		}
		else if($as == 'is_guest')
		{
			array_push($is_guest , $info);
		}
		else if($as == 'deleted')
		{
			array_push($deleted , $info);
		}
		else if($as == 'date_add')
		{
			array_push($date_add , addslashes($info));
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


for($i = 0 ; $i <= (sizeof($arr)/31)-1 ; $i++)//AllData/columnsPerData
{

	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}
	//echo $id_product[$i].'- Numrrows = '.$numrows.'<br>';
	 
			
	
		
			//echo 'replaced into '.$id_customer[$i] . '<br>';
			mysql_query("REPLACE INTO glogdb_clone.glog_customer (id_customer,id_shop_group,id_shop,id_gender,id_default_group,id_lang,id_risk,company,siret,ape,firstname,lastname,email,passwd,last_passwd_gen,birthday,newsletter,ip_registration_newsletter,newsletter_date_add,optin,website,outstanding_allow_amount,show_public_prices,max_payment_days,secure_key,note,active,is_guest,deleted,date_add,date_upd)VALUES(".$id_customer[$i].",".$id_shop_group[$i].",".$id_shop[$i].",".$id_gender[$i].",".$id_default_group[$i].",".$id_lang[$i].",".$id_risk[$i].",'".$company[$i]."','".$siret[$i]."','".$ape[$i]."','".$firstname[$i]."','".$lastname[$i]."','".$email[$i]."','".$passwd[$i]."','".$last_passwd_gen[$i]."','".$birthday[$i]."','".$newsletter[$i]."','".$ip_registration_newsletter[$i]."','".$newsletter_date_add[$i]."',".$optin[$i].",'".$website[$i]."',".$outstanding_allow_amount[$i].",".$show_public_prices[$i].",".$max_payment_days[$i].",'".$secure_key[$i]."','".$note[$i]."',".$active[$i].",".$is_guest[$i].",".$deleted[$i].",'".$date_add[$i]."','".$date_upd[$i]."');",$conn);
		
		$insertedIds .= $id_customer[$i].",";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		
	
	


}


$id_customers_IMPOLODED = implode(', ', $id_customer);
if($id_customers_IMPOLODED != NULL)
{
	$deletesql = "DELETE FROM glog_customer WHERE id_customer NOT IN (".$id_customers_IMPOLODED.")";
}
else
{

	$deletesql = "DELETE FROM `glog_customer`;";

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