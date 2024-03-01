<?php

    function sign_up(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mongoDB = "";
            $database = $mongoDB->selectDatabase('nimi');
            $collection = $database->selectCollection('collection nimi');

            $fullName = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = password_hash(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING), PASSWORD_DEFAULT);
            $confirmPassword = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);
            
            // Kontrollin kas kõik väljad on täidetud
            if (empty($fullName) || empty($email) || empty($password) || empty($confirmPassword)) {
                echo "Palun täidke kõik väljad.";
                exit;
            }
        
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Vale Emaili aadress.";
                exit;
            }
        
            if (substr($email, -strlen("@tlu.ee")) !== "@tlu.ee") {
                echo "Ainult TLÜ emailiga on võimalik registreerida.";
                exit;
            }

            if ($password !== password_hash($confirmPassword, PASSWORD_DEFAULT)) {
                echo "Paroolid on erinevad.";
                exit;
            }
        
            $existingUser = $collection->findOne(['$or' => [['email' => $email]]]);
            if ($existingUser) {
                echo "Email on juba kasutuses.";
                exit;
            }
        
            // Loon dokumendi
            $userDocument = [
                'full_name' => $fullName,
                'email' => $email,
                'password' => $password,
            ];
        
            try {
                $result = $collection->insertOne($userDocument);
        
                // Check if the insertion was successful
                if ($result->getInsertedCount() > 0) {
                    echo "Olete edukalt registreerunud!";
                } else {
                    echo "Tekkis viga registreerimisel.";
                }
            } catch (MongoDB\Driver\Exception\Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    function sign_in(){

    }


