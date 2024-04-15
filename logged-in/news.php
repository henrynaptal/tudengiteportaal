<?php
session_start();
if (!isset($_SESSION['kasutaja'])) {
    header('Location: ../login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="news.css">
    <title>Uudised</title>
</head>
    <body>
        <div class="container">

            <div class="header">
                <nav class="navbar">
                    <ul>
                        <a href="home.php"><img src="https://www.tlu.ee/sites/default/files/2018-05/DTI-est_2.svg" class ="logo" alt="Tallinna Ülikool"></a>
                        <li><a href="news.php">Uudised</a></li>
                        <li><a href="schedule.php">Tunniplaan</a></li>
                        <li><a href="portfolio.php">Minu portfoolio</a></li>
                    </ul>

                    <div class="username">
                        <p>Heli Kopter</p>
                        <a href="edit_profile.php">Muudan andmeid</a>
                    </div>
                </nav>

            </div>


            <div class="wrapper">
                <aside class="sidebar"></aside>

                <div class="news_container">
                    <div class="news_header">
                        <h1>Uudised</h1>
                    </div>

                    

                </div>
            </div>
        </div>

    </body>
</html>