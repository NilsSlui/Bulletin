<?php
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
function ConnectToDB(){
    $login = array("localhost", "root", "root", "bulletin"); //server, user, pass, database
    $conn = new mysqli($login[0], $login[1], $login[2], $login[3]);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    return $conn;
}
function GetMessagesFromDB(){
    $conn = ConnectToDB();
    $listMessage = [];
    $sql = "SELECT id, date, author, title, body FROM messages ORDER BY id DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $listMessage[] = new Message($row['id'],$row['date'],$row['author'],$row['title'],$row['body']);
        }
    }
    $conn->close();
    return $listMessage;
}
function StoreNewMessageToDB($_message){
    $conn = ConnectToDB();
    $sql = "INSERT INTO messages (date, author, title, body)
    VALUES ('$_message->date', '$_message->author', '$_message->title', '$_message->body')";

    if ($conn->query($sql) === TRUE) {
        $r = "Ok";
    } else {
        $r = "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    return $r;
}   
function GetSingleMessageFromDB($_id){
    if(!is_int($_id)) { 
        return 0;
    }

    $sql = "SELECT id, date, author, title, body FROM messages WHERE id=" . $_id; 

    return $sql;
}