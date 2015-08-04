<?php
$conn = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("glogdb_clone");

$data = json_decode(file_get_contents("http://g-log.co/ForI5/?table=glog_guest"),true);

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
$id_guest = array();
$id_operating_system = array();
$id_web_browser = array();
$id_customer = array();
$javascript = array();
$screen_resolution_x = array();
$screen_resolution_y = array();
$screen_color = array();
$sun_java = array();
$adobe_flash = array();
$adobe_director = array();
$apple_quicktime = array();
$real_player = array();
$windows_media = array();
$accept_language = array();
$mobile_theme = array();

foreach($arr as $key => $value)
{
	foreach($value as $as => $info)
	{
		if($as == 'id_guest')
		{
			array_push($id_guest, $info);
		}
		else if($as =='id_operating_system')
		{
			array_push($id_operating_system , $info);
		}
		else if($as =='id_web_browser')
		{
			array_push($id_web_browser , $info);
		}
		else if($as =='id_customer')
		{
			array_push($id_customer , $info);
		}
		else if($as =='javascript')
		{
			array_push($javascript , $info);
		}
		else if($as =='screen_resolution_x')
		{
			array_push($screen_resolution_x , $info);
		}
		else if($as =='screen_resolution_y')
		{
			array_push($screen_resolution_y , $info);
		}
		else if($as =='screen_color')
		{
			array_push($screen_color , $info);
		}
		else if($as == 'sun_java')
		{
			array_push($sun_java , $info);
		}
		else if($as == 'adobe_flash')
		{
			array_push($adobe_flash , $info);
		}
		else if($as == 'adobe_director')
		{
			array_push($adobe_director , $info);
		}
		else if($as == 'apple_quicktime')
		{
			array_push($apple_quicktime , $info);
		}
		else if($as == 'real_player')
		{
			array_push($real_player , $info);
		}
		else if($as == 'windows_media')
		{
			array_push($windows_media , $info);
		}
		else if($as == 'accept_language')
		{
			 array_push($accept_language , addslashes($info));
		}
		else if($as == 'mobile_theme')
		{
			array_push($mobile_theme , $info);
		}
	}
}


$insertedIds = "";
$updatedIds = "";
$errors = array();


for($i = 0 ; $i <= (sizeof($arr)/16)-1 ; $i++)//AllData/columnsPerData
{

	if(mysql_error($conn) != "")
	{
		echo mysql_error($conn);
		array_push($errors, mysql_error($conn));
	}
	//echo $id_product[$i].'- Numrrows = '.$numrows.'<br>';
	 
			
	
		
			//echo 'replaced into '.$id_attribute[$i] . '<br>';
			mysql_query("REPLACE INTO glogdb_clone.glog_guest (id_guest,id_operating_system,id_web_browser,id_customer,javascript,screen_resolution_x,screen_resolution_y,screen_color,sun_java,adobe_flash,adobe_director,apple_quicktime,real_player,windows_media,accept_language,mobile_theme)VALUES(".$id_guest[$i].",".$id_operating_system[$i].",".$id_web_browser[$i].",".$id_customer[$i].",".$javascript[$i].",".$screen_resolution_x[$i].",".$screen_resolution_y[$i].",".$screen_color[$i].",".$sun_java[$i].",".$adobe_flash[$i].",".$adobe_director[$i].",".$apple_quicktime[$i].",".$real_player[$i].",".$windows_media[$i].",'".$accept_language[$i]."',".$mobile_theme[$i].");",$conn);
		
		$insertedIds .= $id_guest[$i].",";
		
		
		if(mysql_error($conn) != "")
		{
			echo mysql_error($conn);
			array_push($errors, mysql_error($conn));
		}
		
	
	


}


$id_guests_IMPOLODED = implode(', ', $id_guest);
if($id_guests_IMPOLODED != NULL)
{
	$deletedsql = "deleted FROM glog_guest WHERE id_guest NOT IN (".$id_guests_IMPOLODED.")";
}
else
{

	$deletedsql = "deleted FROM `glog_guest`;";

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