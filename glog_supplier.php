<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_supplier"),true);

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
$id_supplier = array();
$name = array();
$date_add = array();
$date_upd = array();
$active = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_supplier')
		{
			array_push($id_supplier, intval($info));
		}
		else if($as == 'name')
		{
			array_push($name , addslashes($info));
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
		
	
	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();


for($i = 0 ; $i <= (sizeof($arr)/5)-1 ; $i++)//AllData/columnsPerData
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
			mysql_query("REPLACE INTO glogdb_clone.glog_supplier(id_supplier,name,date_add,date_upd,active)VALUES(".$id_supplier[$i].",'".$name[$i]."','".$date_add[$i]."','".$date_upd[$i]."',".$active[$i].");",$conn);
		
		$insertedIds .= $id_supplier[$i].",";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		
	
	


}


$id_suppliers_IMPOLODED = implode(', ', $id_supplier);
if($id_suppliers_IMPOLODED != NULL)
{
	$deletesql = "DELETE FROM glog_supplier WHERE id_supplier NOT IN (".$id_suppliers_IMPOLODED.")";
}
else
{

	$deletesql = "DELETE FROM `glog_supplier`;";

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