<?php
# Cache-Control Headers
header("Cache-Control: no-store, must-revalidate");
header("Expires: Thu, 01 Jan 1970 00:00:00 GMT");
# Access-Control Headers
header("Access-Control-Allow-Origin:  http://192.168.1.201, http://192.168.1.120, http://192.168.0.108, http://192.168.0.107");
?>