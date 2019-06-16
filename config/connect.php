<?php

//Heroku CLEARDB Connection Info
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"], 1);




$servername = $cleardb_server;
$username = $cleardb_username;
$password = $cleardb_password;
$dbname = $cleardb_db;

try 
    {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
// ========================= config the languages ================================
error_reporting(E_NOTICE ^ E_ALL);
if (is_file('home.php')){
    $path = "";
}elseif (is_file('../home.php')){
    $path =  "../";
}elseif (is_file('../../home.php')){
    $path =  "../../";
}
include_once $path."langs/set_lang.php";
// ================================ user verified badge style 
$verifyUser = "<span style='color: #03A9F4;' data-toggle='tooltip' data-placement='top' title='".lang('verified_page')."' class='fa fa-check-circle verifyUser'></span>";
// ================================ check user if exist or not (for removed account).
$usrSessID = $_SESSION['id'];
$usrRemovedAcc = $conn->prepare("SELECT id FROM signup WHERE id=:usrSessID");
$usrRemovedAcc->bindParam(':usrSessID',$usrSessID,PDO::PARAM_INT);
$usrRemovedAcc->execute();
$$usrRemovedAccCount = $usrRemovedAcc->rowCount();
if (isset($usrSessID)) {
    if($$usrRemovedAccCount < 1){
        session_destroy();
    }
}
?>