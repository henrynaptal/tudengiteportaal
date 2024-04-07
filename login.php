<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DTI tudengite portaal</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="wrapper">

        <div class="login_container">
            <div class="login-header">
                <span>Tallinna Ülikooli Digitehnoloogiate instituudi tudengiportaal<span>
                </div>

                <p>Logi sisse<p>
                <br>

                <form action="" method="POST">
                    <div class="input_box">
                        <input type="text" placeholder="E-post" name="email" id="email" class="input-field" required=""/>
                    </div>
                    <br>
                    <div class="input_box">
                        <input type="text" placeholder="Parool" name="password" id="password" class="input-field" required=""/>
                    </div>
                    <br>
                    <div class="input_box">
                        <input type="submit" name="login" id="login" class="input-submit" value="Logi sisse"/>
                    </div>
                </form>

                <a href="signup.php">Ei ole kontot? Vajuta siia!</a>
            </div>
        </div>
    </div>

</body>
</html>