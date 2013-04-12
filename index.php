<?php
/*  author  skynetdev 
 *  email   skynetdev3@gmail.com
 *  
 */
require_once 'config.php';
require_once 'actions/functions.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?=SITENAME;?></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
    
 
<body >
<!-- start header -->
<?php if(isset($_SESSION['login'])):?>
<div id="loged_as">
    &nbsp; &nbsp; Logged as: <?php echo $_SESSION['login'] ?>
</div>
<?php endif;?>
<div id="logo">
    
    <h2><a href="#" title=" <?=$lng_site_description[$ses_lng]?>  SkynetDev"><img width="80" src="images/logo.png"></a>
         <div> 
             <?=SITENAME;?>
         </div>
    </h2>
    
	
</div>
<div id="menu" >
        <?php
        //include horizontal menu
        if(isset($_SESSION['user_id']))   require_once  'templates/main_menu.php';
        else{
            if(isset($_GET['login_error'])) echo "<font color='#f3".rand(1000,9999)."'>wrong login or password!</font>";
            require_once 'templates/show_login.php';
        }   
        ?>
</div>
<!-- end header -->

<div id="wrapper">
    <!-- start page -->
    <div id="page" >

                    <!-- start content -->
                    <div id="content" >
                            <?php

                                //page includ by actions
                                if(!empty($_REQUEST) && isset($_REQUEST['page'])) $page_name = $_REQUEST['page'];        
                                if(isset($page_name)){

                                   if($page=getPageByName($page_name))       require_once $page;

                                }
                                else    require_once 'templates/home.php';
                            ?>
                    </div>
                    <!-- end content -->
                    <div style="clear: both;">&nbsp;</div>
    </div>
    <!-- end page -->
</div>
<div id="footer">
    <div id="footer_text">&copy;2012 All Rights Reserved. Free Admin Panel for Bliss Dayz Private Server. Alfa version 1.0 Created by <a target="_blank" href="https://github.com/skynetdev/bliss_admin_panel"><font color="#D56E22">SkyNetDev</font></a><br />
    Modded by <a target="_blank" href="https://github.com/UtraTM/Lite_DayZ-Admin-Panel"><font color="#D56E22">Denocle and UltraTM</font></a> for <a target="_blank" href="https://github.com/Stapo/Lite-DayZ-Private-Server"><font color="#D56E22">Lite DayZ Private Server</font></a></div> 

    
        
</div>



</body>

</html>
