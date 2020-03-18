<?php
$curl = curl_init();

$url = "http://localhost/groepswerkAPI_Anneleen_Jordi_2/PhpClientApplication/api.php";

//setting the url of server
curl_setopt($curl, CURLOPT_URL, $url);

//executing the request and storing server's response in variable
$response = curl_exec($curl);
echo $response;
