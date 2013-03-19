<?php

/*  author  skynetdev
 *  email   skynetdev3@gmail.com
 *  show vehicles 
 */

$vehicle_table_rows='';
$full_invetory=false;

//check security permissions
if(!issecurity(true, true, 'entities')) {
    echo "<h2>Access Denied!!</h2>";
    exit;
}

if(isset($_GET['show']) && $_GET['show']=='in_game') {
$title ='Vehicles in game';
	$exestatus = exec('tasklist /FI "IMAGENAME eq '.SERVEREXE.'" /FO CSV');
	$exestatus = explode(",", strtolower($exestatus));
	$exestatus = $exestatus[0];
	$exestatus = str_replace('"', "", $exestatus);
	
	if ($exestatus == strtolower(SERVEREXE)){
		$serverrunning = true;
		//$_SESSION['msg_red'] = 'Server is online!';
	} else {
		$serverrunning = false;
		//$_SESSION['msg_yellow'] = "Server is offline";
	}

	if (isset($_POST["delete_vehicles"])) {
		$delete_vehicles = $_POST["delete_vehicles"];
                print_r($delete_vehicles);
		$vehicles_count = count($delete_vehicles);
		for($i=0; $i < $vehicles_count; $i++)
		{
			$query2 = "SELECT * FROM instance_vehicle WHERE id = ".$delete_vehicles[$i].""; 
			$result2 = mysql_query($query2) or die(mysql_error());
			while ($row2=mysql_fetch_array($result2)) {
					$query2 = "DELETE FROM instance_vehicle WHERE id='".$delete_vehicles[$i]."'";
				$sql2 = mysql_query($query2) or die(mysql_error());
				
			}		
			
		}
	
	}
        
       $query = "SELECT 
                    *,od.Hitpoints as ivcparts
                    ,od.ObjectUID as ivcid,
                    od.Inventory as ivcinventory 
                FROM 
                    object_data as od 
                LEFT JOIN object_spawns as os ON od.ObjectUID=os.ObjectUID
                WHERE  od.Instance=".INSTANCE."
                ORDER BY ivcid";        
        $result = mysql_query($query) or die(mysql_error());
        $total_vehicles = mysql_num_rows($result);
        while ($row=mysql_fetch_array($result)) {
            $vehicle_table_rows .= row_vehicle($row);
        }           

        require_once 'templates/show_vehicles.php';
     
}


if(isset($_GET['show']) && $_GET['show']=='spawns') {
$title ='Spawns locations of vehicles';

$query="SELECT 
            *,
            os.ObjectUID AS wvid,
			oc.Chance AS Chance,
			od.Inventory AS vinventory,
			oc.Hitpoints AS Hitpoints
        FROM 
			object_spawns AS os,
            object_classes AS oc,
			object_data AS od
        WHERE  
			oc.Classname = os.Classname
			AND os.ObjectUID = od.ObjectUID
";
        
     
        $result = mysql_query($query) or die(mysql_error());
        $total_vehicles = mysql_num_rows($result);
        while ($row=mysql_fetch_array($result)) {
            $vehicle_table_rows .= row_vehicle_spawns($row);
        }           

        require_once 'templates/show_spawns.php';
     
}

?>
