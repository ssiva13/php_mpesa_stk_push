<?php
 $stkCallbackResponse = file_get_contents('php://input');
 $logFile = "../logs/stkPushCallbackResponse.json";
 $log = fopen($logFile, "a");
 fwrite($log, $stkCallbackResponse);
 fclose($log);
 