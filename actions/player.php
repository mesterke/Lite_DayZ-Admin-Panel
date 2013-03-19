<?php
$cid = '';
if (isset($_GET['svid'])){
	$survivol_id = $_GET['svid']*1;

    $query ="
        SELECT * FROM player_data pf, character_data sv
        WHERE  sv.CharacterID = $survivol_id
        AND pf.PlayerUID = sv.PlayerUID
        LIMIT 1
";
$res = mysql_query($query) or die(mysql_error());
$number = mysql_num_rows($res);
$row=mysql_fetch_array($res);

	$row['id'] = $row['CharacterID'];
	$row['unique_id'] = $row['PlayerUID'];
	$row['last_updated'] = $row['LastLogin'];
	$row['start_time'] = $row['Datestamp'];

	$Worldspace = str_replace("[", "", $row['Worldspace']);
	$Worldspace = str_replace("]", "", $Worldspace);
	
        $Worldspace = explode(',', $Worldspace);
	$Inventory = $row['Inventory'];
	$Inventory = str_replace("|", ",", $Inventory);
	//$Inventory = str_replace('"', "", $Inventory);
	$Inventory  = json_decode($Inventory);
	$object_array_for_inventory ='';
	$Backpack  = $row['Backpack'];
	$Backpack = str_replace("|", ",", $Backpack);
	//$Backpack  = str_replace('"', "", $Backpack );
	$Backpack  = json_decode($Backpack);
	$model = $row['Model'];

        //get health
	$Medical = str_replace("[", "", $row['Medical']);
	$Medical = str_replace("]", "", $Medical);
	$Medical = explode(",", $Medical);
	$health = 0;
	if(array_key_exists(2,$Worldspace)) $health = number_format ($Medical[7],0);   
        
	$binocular = array();
	$rifle = '<img style="max-width:220px;max-height:92px;" src="images/gear/rifle.png" title="" alt=""/>';
	$pistol = '<img style="max-width:92px;max-height:92px;" src="images/gear/pistol.png" title="" alt=""/>';
	$second = '<img style="max-width:220px;max-height:92px;" src="images/gear/second.png" title="" alt=""/>';
	$heavyammo = array();
	$heavyammoslots = 0;
	$smallammo = array();
	$usableitems = array();
        
        $zombie_kills = $row['KillsZ'];
        $zombi_headshots = $row['HeadshotsZ'];
        $survivor_kills = $row['KillsH'];
        $bandit_kills = $row['KillsB'];
        $name = htmlspecialchars($row['PlayerName']);
        $status = $row['Alive'];
	       


        
	if(isset($Inventory[0])&& isset($Inventory[1]) )
	$Inventory = (array_merge($Inventory[0], $Inventory[1]));
	
                
                
       if(isset($row['zombie_kills']))    $zombie_kills    = $row['zombie_kills'];
       if(isset($row['headshots']))       $zombi_headshots = $row['headshots'];
       if(isset($row['survivor_kills']))  $survivor_kills  = $row['survivor_kills'];
       if(isset($row['bandit_kills']))   $bandit_kills    = $row['bandit_kills'];
             
       				

							

							                    
                
                
	$uknow_item = '';

	for ($i=0; $i<count($Inventory); $i++){
		if(array_key_exists($i,$Inventory)){
			
			$curitem = $Inventory[$i];
			$icount = "";
			if (is_array($curitem)){$curitem = $Inventory[$i][0]; $icount = ' - '.$Inventory[$i][1].' rounds'; }
                        
                        $object_array_for_inventory = getObjectByClassName($curitem);
                        
			if(is_array($object_array_for_inventory)){
				switch($object_array_for_inventory['subtype']){
					case 'binocular':
						$binocular[] = '<img style="max-width:78px;max-height:78px;" src="images/thumbs/'.$curitem.'.png" title="'.$curitem.'" alt="'.$curitem.'"/>';
						break;
					case 'rifle':
						$rifle = '<img style="max-width:220px;max-height:92px;" src="images/thumbs/'.$curitem.'.png" title="'.$curitem.'" alt="'.$curitem.'"/>';
						break;
					case 'pistol':
						$pistol = '<img style="max-width:92px;max-height:92px;" src="images/thumbs/'.$curitem.'.png" title="'.$curitem.'" alt="'.$curitem.'"/>';
						break;
					case 'backpack':
						break;
					case 'heavyammo':
						$heavyammo[] = array('image' => '<img style="max-width:43px;max-height:43px;" src="images/thumbs/'.$curitem.'.png" title="'.$curitem.$icount.'" alt="'.$curitem.$icount.'"/>', 'slots' => $object_array_for_inventory['slots']);
						
						break;
					case 'smallammo':
						$smallammo[] = '<img style="max-width:43px;max-height:43px;" src="images/thumbs/'.$curitem.'.png" title="'.$curitem.$icount.'" alt="'.$curitem.$icount.'"/>';
						break;
					case 'item':
						$usableitems[] = '<img style="max-width:43px;max-height:43px;" src="images/thumbs/'.$curitem.'.png" title="'.$curitem.'" alt="'.$curitem.'"/>';
						break;
					default:
						$s = '';
				}
			} else {
				$_SESSION['unknow_item'][$name][] = $curitem;
			}
		}
	}	


        require_once 'templates/show_player.php';	
        
} ?>        


