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
- https://github.com/Stapo/Lite-DayZ-Private-Server

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

Changing maps:
=================

To make the download smaller we have excluded all maps except Chernarus.

Here is a list of all available maps.
Download the zip file and extract to the "maps" folder in your web directory.

Chernarus [**Download**] (https://www.box.com/s/je11xuxkx1fo2ff6uxir) (Already included)
Lingor [**Download**] (https://www.box.com/s/bma4z0nfhz1dvrz7pq0m)
Panthera [**Download**] (https://www.box.com/s/862v8tdf5slckgo5jjeq)
Takistan [**Download**] (https://www.box.com/s/jjpdm5exkrm1abk4f4h2)
Fallujah [**Download**] (https://www.box.com/s/mtid65xdi5cbhw2njkyy)
Namalsk [**Download**] (https://www.box.com/s/58k0m6s579o5d5ysya0x)
Taviana [**Download**] (https://www.box.com/s/yqw0gk2cud9hm1ckgb8y)
Celle [**Download**] (https://www.box.com/s/oxo486k59gstybnhu90b)


How to UNinstall:
=================

1.  Delete all web files that you previously unzipped.
2.  Drop all tables in your database that starts with "adm_", no other data has been added or modified by this panel.
