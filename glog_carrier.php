<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_carrier&glogdbcloneupdater-access=76ef0d45220fdee3ac883a0c7565e50c"),true);

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
$id_carrier = array();
$id_reference = array();
$id_tax_rules_group = array();
$name = array();
$url = array();
$active = array();
$deleted = array();
$shipping_handling = array();
$range_behavior = array();
$is_module = array();
$is_free = array();
$shipping_external = array();
$need_range= array();
$external_module_name = array();
$shipping_method = array();
$position = array();
$max_width = array();
$max_height = array();
$max_depth  = array();
$max_weight = array();
$grade = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_carrier')
		{
			array_push($id_carrier, $info);
		}
		else if($as == 'id_reference')
		{
			array_push($id_reference , $info);
		}
		else if($as == 'id_tax_rules_group')
		{
			array_push($id_tax_rules_group , $info);
		}
		else if($as == 'name')
		{
			array_push($name , addslashes($info));
		}
		else if($as == 'url')
		{
			array_push($url ,addslashes($info));
		}
		else if($as == 'active')
		{
			array_push($active ,$info);
		}
		else if($as == 'deleted')
		{
			array_push($deleted , $info);
		}
		else if($as == 'shipping_handling')
		{
			array_push($shipping_handling ,$info);
		}
		else if($as == 'range_behavior')
		{
			array_push($range_behavior ,$info);
		}
		else if($as == 'is_module')
		{
			array_push($is_module , $info);
		}
		else if($as == 'is_free')
		{
			array_push($is_free ,$info);
		}
		else if($as == 'shipping_external')
		{
			array_push($shipping_external ,$info);
		}
		else if($as == 'need_range')
		{
			array_push($need_range , $info);
		}
		else if($as == 'external_module_name')
		{
			array_push($external_module_name , addslashes($info));
		}
		else if($as == 'shipping_method')
		{
			array_push($shipping_method , $info);
		}
		else if($as == 'position')
		{
			array_push($position ,$info);
		}
		else if($as == 'max_width')
		{
			array_push($max_width ,$info);
		}
		else if($as == 'max_height')
		{
			array_push($max_height ,$info);
		}
		else if($as == 'max_depth')
		{
			array_push($max_depth ,$info);
		}
		else if($as == 'max_weight')
		{
			array_push($max_weight ,$info);
		}
		else if($as == 'grade')
		{
			array_push($grade , $info);
		}
	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();


for($i = 0 ; $i <= (sizeof($arr)/22)-1 ; $i++)//AllData/columnsPerData
{

	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}
	//echo $id_product[$i].'- Numrrows = '.$numrows.'<br>';
	 
			
	
		
			//echo 'replaced into '.$id_carrier[$i] . '<br>';
			mysql_query("REPLACE INTO glogdb_clone.glog_carrier (id_carrier,id_reference,id_tax_rules_group,name,url,active,deleted,shipping_handling,range_behavior,is_module,is_free,shipping_external,need_range,external_module_name,shipping_method,position,max_width,max_height,max_depth,max_weight,grade)VALUES(".$id_carrier[$i].",".$id_reference[$i].",".$id_tax_rules_group[$i].",'".$name[$i]."','".$url[$i]."',".$active[$i].",".$deleted[$i].",".$shipping_handling[$i].",".$range_behavior[$i].",".$is_module[$i].",".$is_free[$i].",".$shipping_external[$i].",".$need_range[$i].",'".$external_module_name[$i]."',".$shipping_method[$i].",".$position[$i].",".$max_width[$i].",".$max_height[$i].",".$max_depth[$i].",".$max_weight[$i].",".$grade[$i].");",$conn);
		
		$insertedIds .= $id_carrier[$i].",";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		
	
	


}


$id_carriers_IMPOLODED = implode(', ', $id_carrier);
if($id_carriers_IMPOLODED != NULL)
{
	$deletesql = "DELETE FROM glog_carrier WHERE id_carrier NOT IN (".$id_carriers_IMPOLODED.")";
}
else
{

	$deletesql = "DELETE FROM `glog_carrier`;";

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