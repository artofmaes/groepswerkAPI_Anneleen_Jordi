<?php
require_once "../../lib/autoload.php";
require_once "access_control.php";
$apiActions = $Container->getApiActions();
$db = $Container->getDBM();
$uri_parts = explode("/",$_SERVER['REQUEST_URI']);
$count = count($uri_parts);
$last_part = $uri_parts[$count-1];
$previous_part = $uri_parts[$count-2];

if($last_part== "taken"){

   if ($_SERVER['REQUEST_METHOD'] == 'GET'){
       $apiActions->getData();
   }
   if ($_SERVER['REQUEST_METHOD']=='POST'){
       $apiActions->addData();
   }


}elseif($previous_part =="taak"){
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $apiActions->getData($last_part);
    }
    if ($_SERVER['REQUEST_METHOD']=='PUT'){
       $apiActions->updateData($last_part);
    }
    if ($_SERVER['REQUEST_METHOD']=='DELETE'){
        $apiActions->deleteData($last_part);
    }


}else{
    print "Oops! Made a mistake?";
    print "count = $count, previous_part= $previous_part, last_part = $last_part";
}