<?php
// connect to db
require_once 'database.php';
$conn = db_connect();
?>

<?php

// save form inputs into variables
$title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
$year = trim(filter_var($_POST['year'], FILTER_SANITIZE_NUMBER_INT));
$genre = trim($_POST['genre']);
$url = trim($_POST['url']);

$is_form_valid = true;

// check if all inputs are valid
if (empty(trim($title))) {
    echo "Please enter a title";
    $is_form_valid = false;
}


// // check if all inputs are valid
// if (empty(trim($genre))) {
//     echo "Please enter a genre!";
//     $is_form_valid = false;
// }

$year_regex = "/[0-9]{4}/";
// echo preg_match($year_regex, $year);
if ($year < 0 || strlen($year) != 4 || !preg_match($year_regex, $year)) {
    echo "Please enter a valid year";
    $is_form_valid = false;
}

$url_regex = "/https?:\/\/.+\..+/";
if (! preg_match($url_regex, $url)) {
    echo "Please enter a valid url beginning with http:// or https://";
    $is_form_valid = false;
}


if ($is_form_valid) {
    try{
        
        // set up the SQL INSERT command
        $sql = "INSERT INTO games (title, year, genre, url) VALUES (:title, :year, :genre, :url)";

        // create a command object and fill the parameters with the form values
        $cmd = $conn->prepare($sql);
        $cmd -> bindParam(':title', $title, PDO::PARAM_STR, 50);
        $cmd -> bindParam(':year', $year, PDO::PARAM_INT, 50);
        $cmd -> bindParam(':genre', $genre, PDO::PARAM_STR, 32);
        $cmd -> bindParam(':url', $url, PDO::PARAM_STR, 100);

        // execute the command
        $cmd -> execute();

        // disconnect from database
        $conn = null;
    } catch(Exception $e){
        header("Location: error.png"); 
    }

    // show message
    echo "Game Saved?";
}
?>