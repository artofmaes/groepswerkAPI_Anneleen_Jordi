<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/groepswerkAPI_Anneleen_Jordi/Model/Config.php";
//ini_set("error_reporting", E_ALL);
//ini_set("display_errors", 1);
//ini_set("display_startup_errors", 1);
$config = new Config( $path = "/groepswerkAPI_Anneleen_Jordi" );
$_application_folder = $config->getApplicationFolder();
$_root_folder = $config->getRootFolder();

//load Models
require_once $_root_folder . "/Model/AbstractItem.php";
require_once $_root_folder . "/Model/City.php";
require_once $_root_folder . "/Model/Flower.php";
require_once $_root_folder . "/Model/User.php";

//load Services
require_once $_root_folder . "/Service/Authentication.php";

require_once $_root_folder . "/Service/DataLoader.php";
require_once $_root_folder . "/Service/CityLoader.php";
require_once $_root_folder . "/Service/FlowerLoader.php";

require_once $_root_folder . "/Service/Container.php";

require_once $_root_folder . "/Service/DBInterface.php";
require_once $_root_folder . "/Service/PDO_Manager.php";
require_once $_root_folder . "/Service/MYSQLI_Manager.php";

require_once $_root_folder . "/Service/MessageService.php";
require_once $_root_folder . "/Service/UploadService.php";
require_once $_root_folder . "/Service/DownloadService.php";
require_once $_root_folder . "/Service/ViewService.php";

require_once $_root_folder . "/api/ApiActions.php";

session_start();

$Container = new Container( $config );

//rename van veel gebruikte services
$Auth = $Container->getAuthentication();
$DBM = $Container->getDBM();
$MS = $Container->getMessageService();
$VS = $Container->getViewService();

$_SESSION["head_printed"] = false;

//redirect naar NO ACCESS pagina als de gebruiker niet ingelogd is en niet naar
//een publiek toegankelijke pagina gaat (login, registratie of no_access)
if ( ! isset($_SESSION['usr']) AND ! $login_form AND ! $register_form AND ! $no_access AND !$_SERVER['REQUEST_URI'] === 'testspa/api/index.php')
{
    header("Location: " . $config->getApplicationFolder() . "/no_access.php");
}
