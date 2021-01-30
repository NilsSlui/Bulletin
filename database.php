<?php

$login = array("localhost", "root", "root", "bulletin"); //server, user, pass, database

class Message {
    public $id;
    public $date;
    public $author;
    public $title;
    public $body;

    function __construct($id, $date, $author, $title, $body) {
        $this->id = $id; 
        $this->date = $date; 
        $this->author = $author;
        $this->title = $title;
        $this->body = $body;
    }
}
function GetMessagesFromDB($_login){
    $conn = new mysqli($_login[0], $_login[1], $_login[2], $_login[3]);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $listMessage = [];
    $sql = "SELECT id, author, date, title, content FROM messages";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            $listMessage[] = new Message($row['id'],$row['date'],$row['author'],$row['title'],$row['content']);
        }
    }
    else {
        echo "0 results";
    }
    $conn->close();
    return $listMessage;
}
function StoreNewMessageToDB($_login, $_message){
    $sql = "INSERT INTO messages (date, author, title, content)
    VALUES ('John', 'Doe', 'john@example.com')";
}

