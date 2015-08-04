<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_country"),true);

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
$id_country = array();
$id_zone = array();
$id_currency = array();
$iso_code = array();
$call_prefix = array();
$active = array();
$contains_states = array();
$need_identification_number	 = array();
$need_zip_code = array();
$zip_code_format = array();
$display_tax_label = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_country')
		{
			array_push($id_country, $info);
		}
		else if($as == 'id_zone')
		{
			array_push($id_zone ,$info);
		}
		else if($as == 'id_currency')
		{
			array_push($id_currency ,$info);
		}
		else if($as == 'iso_code')
		{
			array_push($iso_code , addslashes($info));
		}
		else if($as == 'call_prefix')
		{
			array_push($call_prefix , $info);
		}
		else if($as == 'active')
		{
			array_push($active ,$info);
		}
		else if($as == 'contains_states')
		{
			array_push($contains_states ,$info);
		}
		else if($as == 'need_identification_number')
		{
			array_push($need_identification_number , $info);
		}
		else if($as == 'need_zip_code')
		{
			array_push($need_zip_code , $info);
		}
		else if($as == 'zip_code_format')
		{
			array_push($zip_code_format , addslashes($info));
		}
		else if($as == 'display_tax_label')
		{
			array_push($display_tax_label , $info);
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
			mysql_query("REPLACE INTO glogdb_clone.glog_country (id_country,id_zone,id_currency,iso_code,call_prefix,active,contains_states,need_identification_number,need_zip_code,zip_code_format,display_tax_label)VALUES(".$id_country[$i].",".$id_zone[$i].",".$id_currency[$i].",'".$iso_code[$i]."',".$call_prefix[$i].",".$active[$i].",".$contains_states[$i].",".$need_identification_number[$i].",".$need_zip_code[$i].",'".$zip_code_format[$i]."',".$display_tax_label[$i].");",$conn);
		
		$insertedIds .= $id_country[$i].",";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		
	
	


}


$id_countrys_IMPOLODED = implode(', ', $id_country);
if($id_countrys_IMPOLODED != NULL)
{
	$deletedsql = "deleted FROM glog_country WHERE id_country NOT IN (".$id_countrys_IMPOLODED.")";
}
else
{

	$deletedsql = "deleted FROM `glog_country`;";

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