<?php

/*  author  skynetdev
 *  email   skynetdev3@gmail.com
 *  
 */

//$query = "SELECT * FROM  instance_vehicle WHERE id = ".$_GET["id"]." LIMIT 1"; 
$vc_id = $_GET['id'];
$query = "
    SELECT   *,
            ivc.Hitpoints as ivcparts,
            ivc.Inventory as ivcinventory,
            ivc.Worldspace as ivcworldspace,
			ivc.Fuel as fuel,
			ivc.Damage as damage
            FROM object_data as ivc
            LEFT JOIN object_spawns as wvc ON ivc.ObjectUID=wvc.ObjectUID
            LEFT JOIN object_classes as vc ON vc.Classname=wvc.Classname
            LEFT JOIN adm_objects as adm_objects ON adm_objects.class_name = vc.Classname
    WHERE 
        ivc.ObjectUID=$vc_id 
    LIMIT 1";

//echo $query;
$result = mysql_query($query) or die(mysql_error());
$number = mysql_num_rows($result);
$row=mysql_fetch_array($result);
	$Worldspace = str_replace("[", "", $row['ivcworldspace']);
	$Worldspace = str_replace("]", "", $Worldspace);
	$Worldspace = str_replace("|", ",", $Worldspace);
	$Worldspace = explode(",", $Worldspace);
	
	$Backpack  = $row['ivcinventory'];
	$Backpack = str_replace("|", ",", $Backpack);
	$Backpack  = json_decode($Backpack);

        
	
	$Hitpoints  = $row['ivcparts'];
	//$Hitpoints  ='[["wheel_1_1_steering",0.2],["wheel_2_1_steering",0],["wheel_1_4_steering",1],["wheel_2_4_steering",1],["wheel_1_3_steering",1],["wheel_2_3_steering",1],["wheel_1_2_steering",0],["wheel_2_2_steering",1],["motor",0.1],["karoserie",0.4]]';
	$Hitpoints = str_replace("|", ",", $Hitpoints);
	//$Backpack  = str_replace('"', "", $Backpack );
	$Hitpoints  = json_decode($Hitpoints);
	
        
        $query = "SELECT * FROM adm_objects WHERE type='object'";
        $result = mysql_query($query);
	$class_name_objects = mysql_fetch_assoc($result);


require_once 'templates/show_vehicle.php';
?>
