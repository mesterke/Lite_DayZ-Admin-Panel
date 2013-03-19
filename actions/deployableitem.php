<?php

/*  author  skynetdev
 *  email   skynetdev3@gmail.com
 *  
 */
$title ='Deployable Item';
 
$vc_id = $_GET['id'];

$query = "SELECT
        od.*,
        pd.PlayerName as pfname,
        cd.Alive,
        cd.CharacterID as svid,
        admo.*,
		od.Datestamp AS last_updated,
		od.Datestamp AS created
    FROM
        object_data AS od,
        player_data AS pd,
        character_data AS cd,
        adm_objects AS admo
    WHERE 
        od.ObjectUID = $vc_id
        AND od.CharacterID =  cd.CharacterID
        AND pd.PlayerUID = cd.PlayerUID
        AND admo.class_name = od.Classname
    LIMIT 1
   
    
    
"; 


   
//echo $query;
$result = mysql_query($query) or die(mysql_error());
$number = mysql_num_rows($result);
$row=mysql_fetch_array($result);
	$Worldspace = str_replace("[", "", $row['Worldspace']);
	$Worldspace = str_replace("]", "", $Worldspace);
	$Worldspace = str_replace("|", ",", $Worldspace);
	$Worldspace = explode(",", $Worldspace);
	
	$Backpack  = $row['Inventory'];
	$Backpack = str_replace("|", ",", $Backpack);
	$Backpack  = json_decode($Backpack);



require_once 'templates/show_deployableitem.php';
?>
