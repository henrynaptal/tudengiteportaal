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
    <link rel="stylesheet" href="schedule.css">
    <title>Tunniplaan</title>
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

                <div class="schedule_container">
                    <div class="schedule_header">
                        <h1>Tunniplaan</h1>
                    </div>

                    <div class="schedule_box">
                        <table>
                            <tr class="weekday">
                                <th width="130" href="#">E</th>
                                <th width="130" href="#">T</th>
                                <th width="130" href="#">K</th>
                                <th width="130" href="#">N</th>
                                <th width="130" href="#">R</th>
                                <th width="130" href="#">L</th>
                                <th width="130" href="#">P</th>
                            </tr>

                            <!-- 
                            <tr>
                                <td>Uurimisseminar 10:15 - 11:45</td> // esiteks peab siin avanema päevaplaan aind peale klikkides,
                                teiseks peab kätte saama andmebaasist päevaplaani
                            </tr>  -->

                        </table>

                    </div>

                </div>
            </div>
        </div>

    </body>
</html>