<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit-profile.css">
    <title>DTI tudengite portaal</title>
</head>
    <body>
        <div class="container">

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


            <div class="wrapper">
                <aside class="sidebar"></aside>

                <div class="edit_container">
                    <div class="edit_header">
                        <h1>Muuda andmeid</h1>
                    </div>

                    
                    <form action="" method="POST">
                        <div class="input_box">
                            <input type="text" placeholder="Eesnimi" name="fname" id="fname" class="input-field" required=""/>
                        </div>

                        <br>

                        <div class="input_box">
                            <input type="text" placeholder="Perekonnanimi" name="lname" id="lname" class="input-field" required=""/>
                        </div>

                        <br>

                        <div class="input_box">
                            <input type="text" placeholder="Email" name="email" id="email" class="input-field" required=""/>
                        </div>

                        <br>

                        <div class="input_box">
                            <input type="text" placeholder="Parool" name="password" id="password" class="input-field" required=""/>
                        </div>

                        <br>

                        <div class="edit_box">
                            <input type="submit" name="signup" id="signup" class="input-submit" value="Värskenda andmed"/>
                        </div>

                        <a href="profile.php">Tagasi</a>

                    </form>
                </div>
            </div>
        </div>

    </body>
</html>