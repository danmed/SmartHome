# SmartHome

Import SmartHome.sql to a MySQL database

Edit Config.inc.php to reflect your MySQL settings

# Examples

Turn On YeeLight Bulb : 

http://IpAddress/SmartHome/index.php?action=on&ip=192.168.2.211&type=yeelight&name=Dan%27s%20Lamp

Turn Off YeeLight Bulb :

http://IpAddress/SmartHome/index.php?action=off&ip=192.168.2.211&type=yeelight&name=Dan%27s%20Lamp

Turn on KanKun K1 Plug : 

http://IpAddress/SmartHome/index.php?action=on&ip=192.168.2.209&type=kankun&name=Electric%20Blanket

Turn off KanKun K1 Plug : 

http://IpAddress/SmartHome/index.php?action=off&ip=192.168.2.209&type=kankun&name=Electric%20Blanket

Turn on Sonoff S20 bulb running <Firmware> : 
  
http://web.danmed.co.uk/SmartHome/index.php?action=on&ip=192.168.2.215&type=sonoff&name=Oil%20Radiator

Turn off Sonoff S20 bulb running <Firmware> : 
  
http://web.danmed.co.uk/SmartHome/index.php?action=off&ip=192.168.2.215&type=sonoff&name=Oil%20Radiator

#Notes

Yeelight bulbs need to be in developer mode and you need YeeCLI installed on the webserver.

Kankun Plugs need to be running relay.cgi and json.cgi to control them

Sonoff Plugs need to be running the sketch from : https://github.com/danmed/Sonoff-Smart-Switch-Sketch/tree/master

