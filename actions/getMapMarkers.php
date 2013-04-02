<?php

/*  author  skynetdev
 *  email   skynetdev3@gmail.com
 *  get Markers for Google Map API
 */
require_once '../config.php';
require_once 'functions.php';
require_once '../modules/rcon.php';
if(!issecurity(true,true,'map')) {echo "<h2>Access Denied!</h2>"; exit;} 

$info = array();
if (!empty($_POST)) {
	foreach ($_POST as $k=>$v) {
		$info[$k] = $v;
	}
} else {
	if (!empty($_GET)) {
		foreach ($_GET as $k=>$v) {
			$info[$k] = $v;
		}
	}
}

$map_perameters_array = getMapParameters(getMapName());              
$markers= "[";
$zindex = 0;

if(  (isset($info['type']) && $info['type'] =='vehicle') || (isset($info['vehicles']) && !empty($info['vehicles']) )) {
          
           $ivcid ='';
          if(isset($info['id']) && !empty($info['id']) ) $ivcid = 'AND od.ObjectUID = '.$info['id']*1;

               $query = "SELECT 
            *,
            os.ObjectUID AS wvid,
			oc.Chance AS Chance,
			od.Inventory AS vinventory,
			oc.Hitpoints AS Hitpoints,
			oc.Classname AS Classname
        FROM 
			object_spawns AS os,
            object_classes AS oc,
			object_data AS od
        WHERE  
			oc.Classname = os.Classname
			AND os.ObjectUID = od.ObjectUID
			$ivcid";        
                $result = mysql_query($query) or die(mysql_error());
                $total_vehicles = mysql_num_rows($result);
                 
                        
                    
                while ($row=  mysql_fetch_assoc($result)) {
                    $x = 0;
                    $y = 0;
                    $Worldspace = str_replace("[", "", $row['Worldspace']);
                    $Worldspace = str_replace("]", "", $Worldspace);
                    $Worldspace = explode(",", $Worldspace);					
                    if(array_key_exists(1,$Worldspace)){$x = $Worldspace[1];}
                    if(array_key_exists(2,$Worldspace)){$y = $Worldspace[2];}
                    $is_destroyed = $row['Damage']==1?'yes':'no';
					$icon_type = mysql_result(mysql_query("SELECT type FROM adm_icons WHERE Classname='".$row['Classname']."' LIMIT 1"), 0);
                    
                   
                    $description = "<h2><a target=\"_blank\" href=\"?page=vehicle&id=".$row['wvid']."\">".$row['Classname']."</a></h2><table ".($is_destroyed=='yes'?'bgcolor=red':'')."><tr><td><img style=\"max-width: 100px;\" src=\"images/vehicles/".$row['Classname'].".jpg\"></td><td>&nbsp;</td><td style=\"vertical-align:top; \"><h2>Position:</h2> horizontal:".world_x($x,getMapName())." vertical:".world_y($y,getMapName())."</br>Destroyed? $is_destroyed</td></tr></table>";
                    $markers .= "['".$row['Classname']."', '".$description."',".$x.", ".$y.", ".$zindex++.", 'images/icons/".(file_exists("../images/icons/".$icon_type.".png")?$icon_type:'unknow').".png'],";
                }    
      
}

if(isset($info['type']) && $info['type'] =='vehicle_spawns') {
    $wvid ='';
    if(isset($info['id']) && !empty($info['id'])) $wvid = 'AND od.ObjectUID = '.$info['id']*1;

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
			$wvid
              ";    

          $result = mysql_query($query) or die(mysql_error());
          $total_vehicles = mysql_num_rows($result);

			while ($row =  mysql_fetch_assoc($result)) {
			$x = 0;
			$y = 0;
			$Worldspace = str_replace("[", "", $row['Worldspace']);
			$Worldspace = str_replace("]", "", $Worldspace);
			$Worldspace = explode(",", $Worldspace);					
			if(array_key_exists(1,$Worldspace)){$x = $Worldspace[1];}
			if(array_key_exists(2,$Worldspace)){$y = $Worldspace[2];}
			$icon_type = mysql_result(mysql_query("SELECT type FROM adm_icons WHERE Classname='".$row['Classname']."' LIMIT 1"), 0);



              $description = "<h2>".$row['Classname']."</h2><table ><tr><td><img style=\"max-width: 100px;\" src=\"images/vehicles/".$row['Classname'].".jpg\"></td><td>&nbsp;</td><td style=\"vertical-align:top; \"><h2>ID:".$row['wvid']."</h2><h2>Change:".($row['Chance']*100)."%</h2><h2>Position:</h2>horizontal:".world_x($x,getMapName())." vertical:".world_y($y,getMapName())."</td></tr></table>";
              $markers .= "['".$row['Classname']."', '".$description."',".$x.", ".$y.", ".$zindex++.", 'images/icons/".(file_exists("../images/icons/".$icon_type.".png")?$icon_type:'unknow').".png'],";                  
          }  
}      
      
      
      
if(isset($info['type']) && $info['type'] == 'deployable' || isset($info['deployables']) && $info['deployables'] == 'deployable'  ){
    $insdepid ='';
    if(isset($info['id']) && !empty($info['id'])) $insdepid = 'AND object_data.ObjectUID = '.$info['id'];          

  $query = "SELECT
			*
		FROM
			object_data
		WHERE
			Classname = 'Hedgehog_DZ' $insdepid OR 
			Classname = 'Wire_cat1' $insdepid OR 
			Classname = 'Sandbag1_DZ' $insdepid OR 
			Classname = 'TentStorage' $insdepid
			
    ";   

	$result = mysql_query($query) or die(mysql_error());
	while ($row=mysql_fetch_array($result)) {
		  $Worldspace = str_replace("[", "", $row['Worldspace']);
		  $Worldspace = str_replace("]", "", $Worldspace);
		  $Worldspace = str_replace("|", ",", $Worldspace);
		  $Worldspace = explode(",", $Worldspace);
		  $x = 0;
		  $y = 0;
		  if(array_key_exists(1,$Worldspace)){$x = $Worldspace[1];}
		  if(array_key_exists(2,$Worldspace)){$y = $Worldspace[2];}
	
		  $class_name = $row['Classname'];

			switch ($class_name){
				case 'TentStorage':
					$icon_type = 'tent';
					break;
				case 'Hedgehog_DZ':
					$icon_type = 'Hedgehog_DZ';
					break;	
				case 'Wire_cat1':
					$icon_type = 'Wire_cat1';
					break;	
				case 'Sandbag1_DZ':
					$icon_type = 'Sandbag1_DZ';
					break;
			}


          $description = "<h2><a href=\"?page=deployableitem&id=".$row['ObjectUID']."\">".$class_name."</a></h2><table><tr><td><img style=\"max-width: 100px;\" src=\"images/vehicles/".$class_name.".jpg\"></td><td>&nbsp;</td><td style=\"vertical-align:top; \"><h2>Position:</h2>horizontal:".world_x($x,getMapName())." vertical:".world_y($y,getMapName())."</td></tr></table>";
          $markers .= "['".$class_name."', '".$description."',".$x.", ".$y.", ".$zindex++.", 'images/icons/".(file_exists("../images/icons/".$icon_type.".png")?$icon_type:'unknow').".png'],";                  
  };          


}
              
      
if(isset($info['players']) && $info['players']=='rcon_online') {  
$answers =  getRconPlayers();       
$players = $answers[0];

if (is_array($players)){
        $pnumber = count($players);
        $players_lobby_array = array();
        for ($i=0; $i<count($players); $i++){
                $in_lobby=false;
                $icon ='';
                if(!isset($players[$i][4])) continue;
                $player_name = $players[$i][4];        

                if(strrpos($player_name, " (Lobby)")) {
                    $in_lobby = true;
                    $player_name = str_replace(" (Lobby)", "", $player_name);

                  }
                else  $player_name = $player_name;                         
//TODO: display message red
                if($_SESSION['msg_red'] .= checkRconPlayerName($player_name, $players[$i][0])) continue;                                                 

                $query = "
                    SELECT *,cd.Inventory as svinventory,cd.Backpack as svbackpack,cd.CharacterID as svid FROM 
                        player_data as pd,
                        character_data as cd
                    WHERE
                        pd.PlayerName LIKE '%$player_name%'
                        AND pd.PlayerUID=cd.PlayerUID
                    ORDER BY Datestamp DESC
                    LIMIT 1";
//                                echo "mysql =$query";
                $res = mysql_query($query);
                $num_row = mysql_num_rows($res);



                $row = mysql_fetch_assoc($res); 
                //echo "<pre>";
                //print_r($row);
                $dead = "";
                $ip = $players[$i][1];
                $ping = $players[$i][2];
                $name = $players[$i][4];
                if($row['Alive'] == 0) $icon ='_dead';
                if($in_lobby) $icon = '_lobby';
                $x = 0;
                $y = 0;                                
                $Worldspace = str_replace("[", "", $row['Worldspace']);
                $Worldspace = str_replace("]", "", $Worldspace);
                $Worldspace = explode(',', $Worldspace);					
                if(array_key_exists(1,$Worldspace)){$x = $Worldspace[1];}
                if(array_key_exists(2,$Worldspace)){$y = $Worldspace[2];}                                
                $uid = $row['svid'];


                $description = "<h2><a target=\"_blank\" href=\"?page=player&svid=".$row['svid']."\">".htmlspecialchars($name, ENT_QUOTES)." - ".$uid."</a></h2><table><tr><td><img style=\"max-width: 100px;\" src=\"images/models/".str_replace('"', '', $row['Model']).".png\"></td><td>&nbsp;</td><td style=\"vertical-align:top; \"><h2>Position:</h2>horizontal:".world_x($x,getMapName())." vertical:".world_y($y,getMapName())."</td></tr></table>";
                $markers .= "['".$name."', '".$description."',".$x.", ".$y.", ".$zindex++.", 'images/icons/player".$icon.".png'],";

        }  //end count players
} // end if no answer
}      
      
  
      
if(isset($info['players']) && $info['players']=='alt_online'  && is_int(ALTERNATIVE_ONLINE_MINUTES)) {       

      $query = "
         SELECT 
             *,
             sv.inventory as svinventory,
             sv.backpack as svbackpack,
             sv.id as svid 
        FROM 
             profile as pf,
             survivor as sv,
             instance as inst
         WHERE
             pf.unique_id=sv.unique_id
             AND inst.id = ".INSTANCE."
             AND inst.world_id=sv.world_id
             AND last_updated BETWEEN NOW()- INTERVAL ".ALTERNATIVE_ONLINE_MINUTES." MINUTE AND NOW()
         ORDER BY last_updated  DESC";   

$markers .= getMapMakersPlayersBD($query,$map_perameters_array, $zindex);    


}
  
  
  
if(isset($info['type']) && $info['type']=='players_all') {       

  $body_id ='';  
  if(isset($info['id']) && !empty($info['id'])) $body_id ='AND cd.CharacterID='.$info['id']*1;  

  $query = "
     SELECT 
         *,
         cd.Inventory as svinventory,
         cd.Backpack as svbackpack,
         cd.CharacterID as svid
    FROM 
         player_data as pd,
         character_data as cd
     WHERE
         pd.PlayerUID = cd.PlayerUID
         $body_id
     ORDER BY Datestamp  DESC";

 $markers .= getMapMakersPlayersBD($query,$map_perameters_array, $zindex);     


}  
  
  
  
if(isset($info['type']) && $info['type']=='players_alive') {       



  $query = "
     SELECT 
         *,
         cd.Inventory as svinventory,
         cd.Backpack as svbackpack,
         cd.CharacterID as svid
    FROM 
         player_data as pd,
         character_data as cd
     WHERE
         pd.PlayerUID = cd.PlayerUID
         AND cd.Alive=1
     ORDER BY Datestamp  DESC"; 

 $markers .= getMapMakersPlayersBD($query,$map_perameters_array, $zindex);     


}    
  
  
  
if(isset($info['type']) && $info['type']=='players_dead') {       



  $query = "
     SELECT 
         *,
         cd.Inventory as svinventory,
         cd.Backpack as svbackpack,
         cd.CharacterID as svid
    FROM 
         player_data as pd,
         character_data as cd
     WHERE
         pd.PlayerUID = cd.PlayerUID
         AND cd.Alive=0
     ORDER BY Datestamp  DESC"; 

 $markers .= getMapMakersPlayersBD($query,$map_perameters_array, $zindex);     


}    
    
  
$markers .= "['Edge of map', 'Edge of Chernarus', 0.0, 0.0, 2, 'images/thumbs/null.png']];";
echo $markers;  //return markers for players
?>
