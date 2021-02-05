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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = htmlspecialchars($_POST['id']);
        $date = htmlspecialchars($_POST['date']);
        $author = htmlspecialchars($_POST['author']);
        $title = htmlspecialchars($_POST['title']);
        $post = htmlspecialchars($_POST['body']);
        $new_m = new Message($id,$date,$author,$title,$post);
        EditMessageFromDB($new_m);
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
                        <?php
                            //create dropdown option for each message
                            for ($x = 1; $x <= GetNumberOfMessagesFromDB(); $x++) {
                                echo "<option value='$x'>$x</option>";
                            } 
                        ?>
                    </select>
                    <input type="submit" value="Select"/>
                </form>
                <form method="post">   
                    <!-- EDIT POST FORM -->
                    <!-- hidden inputs -->
                    <input type=text name="id" value="<?php if(isset($m)){print($m->id);}; ?>" hidden>
                    <input type=text name="date" value="<?php if(isset($m)){print($m->date);}; ?>" hidden>
                    <!-- visible inputs -->
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