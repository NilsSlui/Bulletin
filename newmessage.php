<?php
    require 'database.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // collect value of input fields
        $author = htmlspecialchars($_POST['author']);
        $title = htmlspecialchars($_POST['title']);
        $body = htmlspecialchars($_POST['body']);
        $t=time();
        $date = htmlspecialchars(strval(date("d-m-Y h:m:s",$t)));

        if (!empty($name)||!empty($title)||!empty($message)) {
            $freshpost = new Message(0, $date, $author, $title, $body);
            StoreNewMessageToDB($login, $freshpost);
        } else {
          echo '0';
        }
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <?php require 'header.php' ?>
        <div id="container">
            <div class="post_container">
                <form method="post">
                    <label for="name">Name:</label><br>
                    <input type="text" class="short_input" id="author" name="author" required><br>
                    <label for="title">Title:</label><br>
                    <input type="text" class="short_input" id="title" name="title" required><br>
                    <label for="message">Message:</label><br>
                    <textarea id="message_text" name="body" required></textarea><br>
                    <input type="submit">
                </form>
            </div>
        </div>
    </body>
</html>