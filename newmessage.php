<?php
    require 'database.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // collect value of input field
        $name = $_POST['name'];
        $title = $_POST['title'];
        $message = $_POST['message'];
        $t=time();
        $time = strval(date("d-m-Y h:m:s",$t));

        if (!empty($name)||!empty($title)||!empty($message)) {
            $freshpost = new Message(0,$time, $name, $title, $message);
            print $freshpost->date;
        } else {
          echo $name;
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
                    <input type="text" class="short_input" id="name" name="name" required><br>
                    <label for="title">Title:</label><br>
                    <input type="text" class="short_input" id="title" name="title" required><br>
                    <label for="message">Message:</label><br>
                    <textarea id="message_text" name="message" required></textarea><br>
                    <input type="submit">
                </form>
            </div>
        </div>
    </body>
</html>