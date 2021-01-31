<?php
    require 'database.php';
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if(isset($_GET['id'])){
            $id = intval($_GET['id']);
            if($id != 0){
                $m = (GetSingleMessageFromDB($id));
            }
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
                <form method="get">
                    <!-- POST SELECTER -->
                    <label for="id">Post ID:</label>
                    <select id="id" name="id">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                    <input type="submit" value="Select"/>
                </form>
                <form method="post">   
                    <!-- EDIT POST FORM -->
                    <label for="name">Name:</label><br>
                    <input type="text" class="short_input" id="author" name="author" value="<?php if(isset($m)){print($m->author);}; ?>" required><br>
                    <label for="title">Title:</label><br>
                    <input type="text" class="short_input" id="title" name="title" value="<?php if(isset($m)){print($m->title);}; ?>"required><br>
                    <label for="message">Message:</label><br>
                    <textarea id="message_text" name="body"  required><?php if(isset($m)){print($m->body);};?></textarea><br>
                    <input value="Save" type="submit">
                </form>
            </div>
        </div>
    </body>
</html>