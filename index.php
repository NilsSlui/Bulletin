<?php
     /*
        Simple bulletin board by Nils.
     */
    require 'database.php';
    $listMessage = GetMessagesFromDB();
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php require 'header.php' ?>
        <div id="container">
                <?php
                    foreach ($listMessage as &$value) {
                        print('<div class="post_container">');
                        print('<div class="post_header">');
                        print('<div class="post_header_title">');
                        print($value->author);
                        print(' - ');
                        print($value->title);
                        print('</div>');
                        print('<div class="post_header_date">');
                        print($value->date);
                        print('</div>');
                        print('</div>');
                        print('<div class="post_body">');
                        print($value->body);
                        print('</div>');
                        print('</div><br>');
                    }
                ?>
        </div>
    </body>
</html>