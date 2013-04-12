<?php
/*  author  skynetdev
 *  email   skynetdev3@gmail.com
 *  my youtube  channel only for russians https://www.youtube.com/user/bfpayer
 */

/*	Modified by Denocle and UltraTM to work with Stapo's Lite DayZ Private Server
 *	
 *	Link to project page:
 *	https://github.com/UtraTM/Lite_DayZ-Admin-Panel
 *	
 *	Link to Stapo's Lite DayZ Private Server
 *	https://github.com/Stapo/Lite-DayZ-Private-Server
 */


//============= IMPORTANT =================
// Before you do anything else you must import the SQL file named "admin_panel.sql" found in the "installation" folder to your database.
// Make sure it is imported to the same database as you use for your DayZ server.
// This SQL file will not edit any of the existing tables, it will create 5 other tables with the prefix "adm_".


// Default login information is "superadmin" as username and "123456" as password.


define('INSTANCE', 1);   //Instance ID
// This number is important to get the right map in your web panel.
// Changing this number does not change the map on your server, only the map in your web panel.
// Here is the list of available maps: (If you want to use any other map than Chernarus you need to download the map files seperatly, links to those files can be found on our project page.)
//
// 1 = Chernarus
// 2 = Lingor
// 3 = Panthera
// 4 = Takistan
// 5 = Fallujah
// 6 = Namalsk
// 7 = Taviana
// 8 = Celle

define('DISABLE_ZOOM_5_6', false);
// "true or "false". Disable zoom level 5 and 6 for map. Some maps doesn't have zoom levels 5 and 6. Check your map folder if they contain folders named 6 and 7, if there are none let this be set to "true", or not im not the police.

define('GET_MAP_FOR_ZOOM_5AND6_LOCAL', true);
// "true" or "false". If set to "true" the web panel will try to download zoom levels of the map from the Internet. If set to "false" the panel only display map files that already is downloaded.

define('SITENAME', 'Admin Panel for Stapo\'s Lite DayZ Private Server');
// Set a custom title that is shown in your browser. Remember: If you are using a quote or single quotation mark be sure to escape it with a "\" like shown in the example above.

define('SERVERIP', '127.0.0.1');
// This will be the IP where your DayZ server is. Later you can specify the IP to your database.

define('SERVERPORT', 2302);
// This will be the port as your DayZ server is running on. By default this would be "2302".

define('MYSQLIP', '127.0.0.1');
// The IP as to your database.

define('MYSQLPORT', 3306);
// The port as your MySQL server run on. Default would be "3306".

define('DBNAME', 'dayz');
// The name of your MySQL database.

define('USERNAME', 'dayz');
// The username for your database.

define('PASSWORD', 'mysqlpassword');
// Password for said user.

define('RCONPASSWORD', 'rconpassword');
// Your RCON password. Minimum 6 symbols, must start with a digit and use more digits than letters. (Only useful if your server is running BattleEye, which I hope it is.)

define('ALTERNATIVE_ONLINE_MINUTES', 3);
// If there are no players online you can choose to list players that have been online in a specific time frame. Default would be 3 minutes.

define('MAX_LENGTH_PLAYER_NAME', 20);
// Kick if the name of a player is more than the specified number of symbols. By default this is 20, this function is not working perfectly and can be disabled by setting the value "0".

define('FORBIDDEN_SYMBOLS_FOR_PLAYER_NAME', "\"\\/'`:-*<>");
// Kick player if forbidden symbols found in player name.

define('ASCII_SYMBOLS_ONLY_FOR_PLAYER_NAME', false);
// "true" or "false". Kick player if there are any other symbols than ASCII symbols in player name.

define('UTF8_SYMBOLS_ONLY_FOR_PLAYER_NAME', true);
// "true" or "false". Kick player if there are any other symbols than UTF-8 symbols in player name.

define('ACTION_FORBIDDEN_ITEMS', 3);
// Forbidden items for players can be choosen in the web panel and here you can choose how the web panel will deal with players having such items.
// If set to: 0 = disabled check, 1 = ban by Ip and GUID permanently, 2 = kick, 3 = warn admins by logging in the web panel.

define('VIP_PLAYERS', '');
// Players who will not be checked for forbidden items in inventory. For example: define('VIP_PLAYERS','player_name1, player_name2');


// If you want to be able to start and stop your server from within the web panel you need to set up theese parameters correctly.
// Also you will have to change the code of "@Start.bat" to work with your specific settings.
// If you don't do this or don't know how to setup a bat-file then you will have to skip the rest of theese steps and live with not being able to use this function.
// Otherwise I have setup the "@Start.bat" to work for my specific setup. It is just up to you to change the values manually.

// ======== Important ========
// You will only be able to use this function if you are hosting the web server that you are using this web panel on the same machine as you are hosting your DayZ server.
// If you aren't, this function will not work.

define('GAME_PATH', 'C:'.DS.'DayZserver');
// Full path to where you have your DayZ server. Do not use any spaces, if you do, please go and rename those folders.
// Also, "'.DS.'" stands for "Directory seperator" which means "\" for Windows machines and "/" for Linux based operating systems.
// You could probably use slashes in this variable, but if it doesn't work, change all the slashes in your path to look like the example above which in real life would be "C:\DayZserver".

define('SERVEREXE', 'arma2oaserver.exe');
// The name of the process that will be your DayZ server. Default would be "arma2oaserver.exe".
// This will be used to check if your server is running in the web panel. Even if you don't figure out how to make a bat-file this part of the function will still work.

define('ADM_START_SERVER','@Start.bat');
// This is the file that will be executed if you choose to start the server from the web panel.
// The web panel should copy this file from the "installation" folder to your server directory the first time you enter "Server Control" -> "Control" in your web panel.

define('SERVER_START_FILE', GAME_PATH.DS.ADM_START_SERVER);
// Full path to the file that will be executed when you choose to start your server from your web panel.
// Normally you won't need to change this.

define('SERVEREXE_PATH', GAME_PATH.DS."expansion".DS."beta".DS.SERVEREXE);
// Full path to where your server exe-file.
// Normally you won't need to change this. To be honest, I not sure if this variable even is needed.

// BEC settings
define('BEC_PATH', GAME_PATH.DS.'BEC');
// Path to where you have BEC installed.

define('BECEXE', 'BEC.exe');
// Name of your BEC exe-file. Default would be "BEC.exe".

define('BEC_STRING', ' -f config.cfg');
// Start parameters for BEC. Default would be " -f config.cfg".

?>
