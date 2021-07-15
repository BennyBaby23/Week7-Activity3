
<?php
require_once 'db_cred.php';

function db_queryAll($sql, $conn) {
    try{
        global $conn;
        // run query and store the results
        $cmd = $conn->prepare($sql);
        $cmd -> execute();
        $games = $cmd->fetchAll();
        return $games;
    } catch(Exception $e) {
        header("Location: error.php");
    }
}

function db_queryOne($sql, $conn) {
    try{
        global $conn;
        // run query and store the results
        $cmd = $conn->prepare($sql);
        $cmd -> execute();
        $games = $cmd->fetch();
        return $games;
    }catch(Exception $e){
        header("Location: error.php"); 

    }
}

function db_connect() {
    $conn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

function db_disconnect() {
    if (isset($conn)){
        // disconnect
        $conn = null;
    }
}
?>