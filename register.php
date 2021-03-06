<?php

require_once 'database.php';
$conn = db_connect();


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $new_password = filter_var($_POST['new-password'], FILTER_SANITIZE_STRING);
    $confirm_password = filter_var($_POST['confirm-password'], FILTER_SANITIZE_STRING);
    
    // echo "$email $new_password $confirm_password";
    // exit;

    $errors = [];
    $errors['email'] = "Email cannot be blank";
    $errors['password'] = "Password cannot be blank";
    $errors['confirm'] = "Confirmation Password cannot be blank";
    
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO  users(username,hashed_password) ";
    $sql .= "VALUES (:username, :password)";
    
    $cmd = $conn -> prepare($sql);
    $cmd -> bindParam(':username', $email, PDO::PARAM_STR, 50);
    $cmd -> bindParam(':password', $hashed_password, PDO::PARAM_STR, 255);
    $cmd -> execute();
    
    $conn = null;
    
    header("Location: login.php");
    exit;
} 

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
    html {
        background: url(img/register.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    </style>
</head>

<body>
    <div class="container">

        <div class="card position-absolute top-50 start-50 translate-middle" style="width: 700px">
            <h1 class="card-title fs-5 mt-4 text-center">CREATE ACCOUNT</h1>

            <div class="row justify-content-center">
                <form action="register.php" class="p-5" method="POST">
                    <div class="form-floating mb-4">
                        <input type="email" required name="email"
                            class=" rounded-0 form-control" id="email"
                            placeholder="name@example.com">
                        <label for="email">Email Address</label>
                        <p class="text-danger"></p>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" required name="new-password"
                            class=" rounded-0 form-control"
                            id="new-password" placeholder="Password">
                        <label for="new-password">New Password</label>
                        <p class="text-danger"></p>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" required name="confirm-password"
                            class=" rounded-0 form-control"
                            id="confirm-password" placeholder="Confirm Password">
                        <label for="confirm-password">Confirm Password</label>
                        <p class="text-danger"></p>
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-success btn-lg mb-5">
                            Sign Up
                        </button>
                    </div>
                </form>
                <p class="text-center">Already have an account? <a href="login.php" class="text-dark"><strong>Login here
                            </stronng></a></p>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>