<?php

//this pulls the MongoDB driver from vendor folder
require_once __DIR__ . '/../vendor/autoload.php';

//connect to MongoDB Database

// muuda strinigs pw ja user ära
$databaseConnection = new MongoDB\Client(
    'mongodb+srv://Tenso:Dti2023@cluster0.v10lvza.mongodb.net/?tls=true&tlsCAFile=C%3A%5Cxampp%5Capache%5Cbin%5Ccurl-ca-bundle.crt'
);

//connecting to specific database in mongoDB
$myDatabase = $databaseConnection->DTI_Database;

//connecting to our mongoDB Collections
$userCollection = $myDatabase->users;

$postitusteKollektsioon = $myDatabase->postitused;

$adminKollektsioon = $myDatabase->admins;

$uudisteKollektsioon = $myDatabase->news;
