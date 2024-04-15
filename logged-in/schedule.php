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
    <link rel="stylesheet" href="schedule.css">
    <title>Tunniplaan</title>
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