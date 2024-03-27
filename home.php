<?php

    session_start();
        require_once("DB/config.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DTI tudengite portaal</title>

    <style>

        body {
            margin: 0;
        }

        .navbar {
        }

        .header {
            margin-top: 2rem;
            padding-left: 5rem;
            padding-right: 5rem;
            align-items: flex-end; /*et nav osa oleks divi all osas, mitte yleval*/
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: white; 
        }

        li {
            float: right;
        }

        li a {
            display: block;
            color: #3c4445;
            font-style: italic;
            font-family: "Times New Roman", serif;
            text-transform: uppercase;
            text-align: center;
            padding: 2rem 2rem;
            text-decoration: none;
            z-index: 2;
        }

        li a:hover {
            color: #6bcaba;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            background: #6bcaba;
            display: flex;
            z-index: 0;
            width: 15%;
            height: 100%;
            margin-top: 10%;
        }

    </style>
</head>

<body>
    <div class="header">

        <nav class="navbar">
            <ul>
                <div class="logo">
                    <a href="/dt" title="Avaleht" rel="home" class="site-logo">
                        <img src="https://www.tlu.ee/sites/default/files/2018-05/DTI-est_2.svg" alt="Tallinna Ülikool">
                    </a>
                </div>
    
                <li><a href="#uudised">Uudised</a></li>
                <li><a href="#tunniplaan">Tunniplaan</a></li>
                <li><a href="#portfoolio">Minu portfoolio</a></li>
            </ul>
        </nav>

    </div>

    <!--
    <div class="dp">
        <img src="pics/dp2.jpg" alt="students">
        <a href="#" class="dp"><img src="tudengiteportaal-main\pics\dp2.jpg" alt="students"></a>

    </div> -->

    <div class="sidebar"></div> 

</body>
</html>