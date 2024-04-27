<?php
require_once __DIR__ . '/../vendor/autoload.php';
session_start();
if (!isset($_SESSION['kasutaja'])) {
    header('Location: ../login.php');
    exit;
}
$kasutaja = $_SESSION['kasutaja'];


$databaseConnection = new MongoDB\Client('mongodb+srv://Tenso:Dti2023@cluster0.v10lvza.mongodb.net/?tls=true&tlsCAFile=C%3A%5Cxampp%5Capache%5Cbin%5Ccurl-ca-bundle.crt');
$myDatabase = $databaseConnection->DTI_Database;
$userCollection = $myDatabase->users;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $parool = sha1($_POST['password']);

    $userCollection->updateOne(
        ['_id' => $_POST['kasutaja']['_id']],
        ['$set' => ['email' => $email, 'parool' => $parool]]
    );

    header('Location: home.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/d90f70bb05.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="edit_profile.css">
        <title>Andmete muutmine</title>
    </head>

    <body>
        <div class="container">

            <div class="header">
                <nav class="navbar">
                    <ul>
                        <a href="home.php"><img src="https://www.tlu.ee/sites/default/files/2018-05/DTI-est_2.svg" class ="logo" alt="Tallinna Ülikool"></a>
                        <li><a href="posts.php">Projektid</a></li>
                        <li><a href="news.php">Uudised</a></li>
                        <li><a href="schedule.php">Tunniplaan</a></li>
                        <li><a href="portfolio.php">Minu portfoolio</a></li>
                    </ul>

                    <div class="username">
                        <p><?php echo $kasutaja->offsetGet('eesnimi') . " " . $kasutaja->offsetGet('perekonnanimi');?></p>
                        <div class="icons">
                            <div class="data">
                                <a href="edit_profile.php"><i class="fa-solid fa-gear" style="color: #6bcaba;"></i></a>
                            </div>

                            <div class="out">
                                <a href="logout.php"><i class="fa-solid fa-right-from-bracket" style="color: #6bcaba;"></i></a>
                            </div>
                        </div>
                        
                    </div>
                </nav>

            </div>


            <div class="wrapper">
                <aside class="sidebar"></aside>

                <div class="edit_container">
                    <div class="edit_header">
                        <h1>Muuda andmeid</h1>
                    </div>

                    
                    <form action="" method="POST">
                        <div class="input_box">
                            <input type="text" placeholder="Eesnimi" name="fname" id="fname" class="input-field" disabled />
                        </div>

                        <br>

                        <div class="input_box">
                            <input type="text" placeholder="Perekonnanimi" name="lname" id="lname" class="input-field" disabled/>
                        </div>

                        <br>

                        <div class="input_box">
                            <input type="text" placeholder="E-post" name="email" id="email" class="input-field" required=""/>
                        </div>

                        <br>

                        <div class="input_box">
                            <input type="password" placeholder="Parool" name="password" id="password" class="input-field" required=""/>
                        </div>

                        <br>

                        <div class="buttons">
                            <div class="back_box">
                                <input type="submit" name="go_back" id="go_back" class="back-submit" href="javascript:history.go(-1)" value="Katkestan"/>
                            </div>

                            <div class="edit_box">
                                <input type="submit" name="edit" id="edit" class="input-submit" value="Värskendan"/>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </body>
</html>