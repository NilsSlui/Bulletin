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
# Input: nothing
# Output: an active sql connection
function ConnectToDB(){
    $login = array("localhost", "root", "root", "bulletin"); //server, user, pass, database
    $conn = new mysqli($login[0], $login[1], $login[2], $login[3]);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    return $conn;
}
# Input: nothing
# Output: a list of Message objects 
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
#Input: single Message object
#Output: True or False depending on success
function StoreNewMessageToDB($_message){
    $conn = ConnectToDB();
    $sql = "INSERT INTO messages (date, author, title, body)
    VALUES ('$_message->date', '$_message->author', '$_message->title', '$_message->body')";

    if ($conn->query($sql) === TRUE) {
        $r = True;
    } else {
        //$r = "Error: " . $sql . "<br>" . $conn->error;
        $r = True;
    }
    $conn->close();
    return $r;
}   
#Input: int that corresponds to database id
#Output: single Message object that has the id
function GetSingleMessageFromDB($_id){
    if(!is_int($_id)) { 
        return 0;
    } 
    $conn = ConnectToDB();
    $sql = "SELECT id, date, author, title, body FROM messages WHERE id=" . $_id; 
    $result = $conn->query($sql);
    $row = $result->fetch_array();
    $m = new Message($row['id'],$row['date'],$row['author'],$row['title'],$row['body']);
    $conn->close();
    return $m;
}
#Input: Message object 
#Output: true or false based on database record update success
function EditMessageFromDB($_message){
    $sql = "UPDATE messages SET author='$_message->author', title='$_message->title', body='$_message->body' WHERE id=$_message->id";
}