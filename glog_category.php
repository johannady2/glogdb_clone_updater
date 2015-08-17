<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_category&glogdbcloneupdater-access=76ef0d45220fdee3ac883a0c7565e50c"),true);

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
$id_category = array();
$id_parent = array();
$id_shop_default = array();
$level_depth = array();
$nleft = array();
$nright = array();
$active = array();
$date_add = array();
$date_upd = array();
$position = array();
$is_root_category = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_category')
		{
			array_push($id_category, $info);
		}
		else if($as == 'id_parent')
		{
			array_push($id_parent, $info);
		}
		else if($as == 'id_shop_default')
		{
			array_push($id_shop_default, $info);
		}
		else if($as == 'level_depth')
		{
			array_push($level_depth , $info);
		}
		else if($as == 'nleft')
		{
			array_push($nleft , $info);
		}
		else if($as == 'nright')
		{
			array_push($nright , $info);
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
			array_push($date_upd , addslashes($info));
		}
		else if($as == 'position')
		{
			array_push($position , addslashes($info));
		}
		else if($as == 'is_root_category')
		{
			array_push($is_root_category, $info);
		}
	
	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();


for($i = 0 ; $i <= (sizeof($arr)/11)-1 ; $i++)//AllData/columnsPerData
{

	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}
	//echo $id_product[$i].'- Numrrows = '.$numrows.'<br>';
	 
			
	
		
			//echo 'replaced into '.$id_category[$i] . '<br>';
mysql_query("REPLACE INTO glogdb_clone.glog_category (id_category,id_parent,id_shop_default,level_depth,nleft,nright,active,date_add,date_upd,position,is_root_category)VALUES(".$id_category[$i].",".$id_parent[$i].",".$id_shop_default[$i].",".$level_depth[$i].",".$nleft[$i].",".$nright[$i].",".$active[$i].",'".$date_add[$i]."','".$date_upd[$i]."','".$position[$i]."',".$is_root_category[$i].");",$conn);
		
		$insertedIds .= $id_category[$i].",";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		
	
	


}


$id_categorys_IMPOLODED = implode(', ', $id_category);
if($id_categorys_IMPOLODED != NULL)
{
	$deletesql = "DELETE FROM glog_category WHERE id_category NOT IN (".$id_categorys_IMPOLODED.")";
}
else
{

	$deletesql = "DELETE FROM `glog_category`;";

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