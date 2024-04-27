<?php
require_once __DIR__ . '/../vendor/autoload.php';
session_start();

if (!isset($_SESSION['kasutaja'])) {
    header('Location: ../login.php');
    exit;
}

$kasutaja = $_SESSION['kasutaja'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/d90f70bb05.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="home.css">
    <title>Pealeht</title>
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

            <div class="dp">
                <img src="../pics/dp2.jpg" alt="students">
            </div>
            <div class="wrapper">
                <aside class="sidebar"></aside>

                <div class="welcome">
                    <h1>Tere, <?php echo $kasutaja->offsetGet('eesnimi');?>!</h1>
                    <h2>Kuidas Sa end täna tunned?</h2>
                </div>
            </div>
        </div>

    </body>
</html>