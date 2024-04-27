<?php
require_once __DIR__ . '/../vendor/autoload.php';
session_start();

if (!isset($_SESSION['kasutaja'])) {
    header('Location: ../login.php');
    exit;
}

$kasutaja = $_SESSION['kasutaja'];

$databaseConnection = new MongoDB\Client(
    'mongodb+srv://Tenso:Dti2023@cluster0.v10lvza.mongodb.net/?tls=true&tlsCAFile=C%3A%5Cxampp%5Capache%5Cbin%5Ccurl-ca-bundle.crt'
);

$myDatabase = $databaseConnection->DTI_Database;
$postCollection = $myDatabase->posts;

$posts = $postCollection->find([], ['sort' => ['timestamp' => -1]]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['like'])) {
        $post_id = $_POST['post_id'];
        $postCollection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($post_id)],
            ['$inc' => ['likes' => 1]]
        );
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/d90f70bb05.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="posts.css">
        <title>Avalikud postitused</title>
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

                <div class="posts_container">
                    <div class="posts_header">
                        <h1>Avalikud projektid</h1>
                    </div>


                    <?php foreach ($posts as $post): ?>
                        <div class="post">
                            <p><?php echo $post['sisu']; ?></p>
                            <p>Autor: <?php echo $post['kasutaja']['eesnimi'] . ' ' . $post['kasutaja']['perekonnanimi']; ?></p>
                            <a href="post.php?id=<?php echo $post['_id']; ?>"><button type="button">Vaata rohkem</button></a>
                            <form>
                                <input type="hidden" name="post_id" value="<?php echo $post['_id']; ?>">
                                <button type="button" onclick="likePost('<?php echo $post['_id']; ?>')">Märgi meeldivaks</button> 
                            </form>
                            <p id="likes_<?php echo $post['_id']; ?>"><?php echo $post['likes']; ?><i class="fa-solid fa-heart" style="color: #6bcaba;"></i></p> 
                        </div>
                    <?php endforeach; ?>


                    <script>
                        function likePost(postId) {
                            var xhr = new XMLHttpRequest();
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState == 4 && xhr.status == 200) {
                                    var likesElement = document.getElementById('likes_' + postId);
                                    likesElement.innerHTML = xhr.responseText + ' Likes';
                                }
                            };
                            xhr.open("POST", "like.php", true);
                            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhr.send("post_id=" + postId);
                        }
                        
                        document.querySelectorAll('.like-btn').forEach(button => {
                            button.addEventListener('click', async function() {
                                const postId = this.getAttribute('data-post-id');
                                const response = await fetch('like.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                    },
                                    body: JSON.stringify({ postId }),
                                });
                                if (response.ok) {
                                    button.classList.add('disabled');
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </body>
</html>
