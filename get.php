<?php
    $result = file_get_contents('http://requestbin.fullcontact.com/rqni85rq');
    echo $result. "\n";

    $str = '174379bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c91920180409093002';
echo base64_encode($str);
?>