<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","petleya-db","h4QQvoY9jtkpIVYy","petleya-db");
if(!$mysqli || $mysqli->connect_errno){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }
if(!($stmt = $mysqli->prepare("SELECT zuser.uid FROM zuser WHERE zuser.username = ?"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
$usr = "weckwera";
if(!($stmt->bind_param("s",$usr))){
    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($uid)){
    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
//    echo "<tr>\n<td>\n".$uid."\n</td>\n</tr>";
}
if(!($stmt = $mysqli->prepare("INSERT INTO zuserplants(userID, plantID) VALUES (?,?)"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ii",$uid,$_POST["addfarm"]))){
    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
}
// else {
//    echo "You added" . $stmt->affected_rows . " plant.";
//}
$stmt->close();
header("Location: main.php");
?>
