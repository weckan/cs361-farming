<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "petleya-db", "h4QQvoY9jtkpIVYy",
    "petleya-db");
?>
 <form method="post" action="addtofarm.php">
     <!--    <fieldset> -->
         <legend>Add a Crop to Your Farm:</legend>
         <select name="addfarm">
<?php
if ($mysqli->connect_errno) {
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!($stmt = $mysqli->prepare("SELECT plantid, plantName FROM zplant2"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
     echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!$stmt->bind_result($plantid,$name)){
    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
 while($stmt->fetch()){
   echo '<option value=" '. $plantid . ' "> ' . $name . '</option>\n';
 }
$stmt->close();
?>
         </select>
         </fieldset>
         <p><input type="submit"/></p>
     </form>
       </body>
 </html>
