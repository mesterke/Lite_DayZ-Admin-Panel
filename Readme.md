Admin web panel for Stapo's DayZ lite private server
=================
Info
=================
This is the SkynetDev's admin panel modified for Stapo's DayZ Lite Private server.
Original panel can be found here: https://github.com/skynetdev/bliss_admin_panel

Currently working on new functions but should now be working for DayZ 1.7.6.1

-----------------

What you need to make this work:
=================
https://github.com/Stapo/Lite-DayZ-Private-Server

1. A working installation of Stapo's Lite DayZ private server, see link above.
2. A web server with PHP.
3. A working MySQL server.

-----------------

How to install:
=================

1.  Start by downloading this admin panel and unzip the zip files on your web server.
2.  Import the SQL file that is included in this zip to your MySQL server. The file is found in the "installation" folder.
3.  Edit the "adm_config.php" that was included in the zip file.
    In this file you choose what map you are using and also enter all your MySQL information.
    Don't forget to also enter your RCON password.
4.  Login to your admin panel with username "superadmin" and password "123456", don't forget to change this password from within the panel.
    You can also add new users with the panel, but you can't change the username on the accout "superadmin".

-----------------

How to UNinstall:
=================

1.  Delete all web files that you previously unzipped.
2.  Drop all tables in your database that starts with "adm_", no other data has been added or modified by this panel.
