<?php
# Cache-Control Headers
header("Cache-Control: no-store, must-revalidate");
header("Expires: Thu, 01 Jan 1970 00:00:00 GMT");
# Access-Control Headers
#header("Access-Control-Allow-Origin: http://iot.comteq.edu.ph, http://iot.comteq.edu.ph:50001, http://172.16.2.250, http://172.16.2.252");


header("Access-Control-Allow-Origin: http://192.168.0.108, http://192.168.0.105");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
?>  