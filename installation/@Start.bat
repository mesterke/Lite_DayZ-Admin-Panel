@echo off
echo.
echo Starting server
rem Resources\mysql.exe --user=%mysqluser% --password=%mysqlpass% --host=127.0.0.1 --port=3306 --database=%mysqldb% --execute="call pMain()"
start .\Expansion\beta\arma2oaserver.exe -port=2302 -mod=@DayZ;@Server -name=Dayz -config=Config_DayZChernarus\ServerSettings.cfg -cfg=Config_DayZChernarus\arma2.cfg -profiles=Config_DayZChernarus
echo.
ping 127.0.0.1 -n 15 >NUL
echo Starting BEC
echo.
start .\Bec.exe -f \config.cfg
exit