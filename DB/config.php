<?php

//this pulls the MongoDB driver from vendor folder
require_once __DIR__ . '/vendor/autoload.php';

//connect to MongoDB Database

// muuda strinigs pw ja user ära
$databaseConnection = new MongoDB\Client(
    'mongodb+srv://SIIAUSER:SIIAPW@cluster0.v10lvza.mongodb.net/?tls=true&tlsCAFile=C%3A%5Cxampp%5Capache%5Cbin%5Ccurl-ca-bundle.crt'
);

//connecting to specific database in mongoDB
$myDatabase = $databaseConnection->DTI_Database;

//connecting to our mongoDB Collections
$userCollection = $myDatabase->users;

// if($userCollection){
// 	echo "Collection ".$userCollection." Connected";
// }
// else{
// 	echo "Failed to connect to Database/Collection";
// }

if (isset($_POST['signup'])) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phoneNo = $_POST['phoneNo'];
    $password = sha1($_POST['password']);
}

$data = array(
    "Firstname" => $fname,
    "Lastname" => $lname,
    "Email" => $email,
    "Phone Number" => $phoneNo,
    "Password" => $password
);

//insert into MongoDB Users Collection
$insert = $userCollection->insertOne($data);

if ($insert) {
    ?>
    <center>
        <h4 style="color: green;">Successfully Registered</h4>
    </center>
    <center><a href="../index.php">Login</a></center>
    <?php
} else {
    ?>
    <center>
        <h4 style="color: red;">Registration Failed</h4>
    </center>
    <center><a href="inseert.php">Try Again</a></center>
    <?php
}