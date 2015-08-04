<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_order_history"),true);

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
$id_order_history = array();
$id_employee = array();
$id_order = array();
$id_order_state = array();
$date_add = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_order_history')
		{
			array_push($id_order_history, $info);
		}
		else if($as == 'id_employee')
		{
			array_push($id_employee ,$info);
		}
		else if($as == 'id_order')
		{
			array_push($id_order ,$info);
		}
		else if($as == 'id_order_state')
		{
			array_push($id_order_state ,$info);
		}
		else if($as == 'date_add')
		{
			array_push($date_add ,addslashes($info));
		}
	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();


for($i = 0 ; $i <= (sizeof($arr)/5)-1 ; $i++)//AllData/columnsPerData
{

	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}
	//echo $id_product[$i].'- Numrrows = '.$numrows.'<br>';
	 
			
	
		
			//echo 'replaced into '.$id_order_history[$i] . '<br>';
			mysql_query("REPLACE INTO glogdb_clone.glog_order_history(id_order_history,id_employee,id_order,id_order_state,date_add)VALUES(".$id_order_history[$i].",".$id_employee[$i].",".$id_order[$i].",".$id_order_state[$i].",'".$date_add[$i]."');",$conn);
		
		$insertedIds .= $id_order_history[$i].",";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		
	
	


}


$id_order_historys_IMPOLODED = implode(', ', $id_order_history);
if($id_order_historys_IMPOLODED != NULL)
{
	$deletesql = "DELETE FROM glog_order_history WHERE id_order_history NOT IN (".$id_order_historys_IMPOLODED.")";
}
else
{

	$deletesql = "DELETE FROM `glog_order_history`;";

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