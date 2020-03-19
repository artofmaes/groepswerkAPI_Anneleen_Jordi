<?php
require_once "../../lib/autoload.php";
require_once "access_control.php";
$apiActions = $Container->getApiActions();
$db = $Container->getDBM();
$uri_parts = explode("/",$_SERVER['REQUEST_URI']);
$count = count($uri_parts);
$last_part = $uri_parts[$count-1];
$previous_part = $uri_parts[$count-2];

if($count == 5 and  $last_part== "taken"){

   if ($_SERVER['REQUEST_METHOD'] == 'GET'){
       $data = $db->GetData("SELECT * from taak");
       echo json_encode($data);
   }
   if ($_SERVER['REQUEST_METHOD']=='POST'){
       $apiActions->addData();
   }


}elseif($count == 6 and $previous_part =="taak"){
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $data = $db->GetData("SELECT * from taak where taa_id = '".$last_part."'");
        echo json_encode($data);
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

// Form begin ----------------------------------------------------------------------
require_once "../../lib/autoload.php";
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>

<div class="jumbotron text-center">
    <h1>API tester taken</h1>
</div>
<div class="container">
    <div class="row">
        <form id="form_get" method="post" action="#">
            <input type="hidden" id="formname" name="formname" value="form_get">
            <input type="hidden" id="tablename" name="tablename" value="taken">
            <input type="hidden" id="pkey" name="pkey" value="taa_id">

            <input name="submitGet" type="submit" value="GET alle taken" class="col-2">
        </form>

    </div>
</div>

<?php
//SUBMIT
if ( $_POST['submitGet'] == "GET alle taken" )
{
    echo '<p>hier komt iets</p>';
}
?>

</body>
</html>

