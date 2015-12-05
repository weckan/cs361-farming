<?php

//error_reporting(0); #(E_ALL);
error_reporting(E_ALL);
//ini_set('display_errors', 'Off');
ini_set('display_errors', 'On');

//connect to database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "petleya-db", "h4QQvoY9jtkpIVYy",
    "petleya-db");
if ($mysqli->connect_errno) {
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

$username = $_POST["usr"];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
 <body>
  <div>
   <table>
    <tr>
     <td>Plant Name</td>
     <td>Groom Type</td>
     <td>Groom xWeek</td>
     <td>Organic Name</td>
     <td>Organic Amount</td>
     <td>Organic xWeek</td>
     <td>Pesticide Type</td>
     <td>Pesticide Amount</td>
     <td>Pesticide xWeek</td>
     <td>Food Type</td>
     <td>Food Amount</td>
     <td>Food xWeek</td>
     <td>Sun Level</td>
     <td>Sun Duration</td>
     <td>Sun xDay</td>
     <td>Water Amount</td>
     <td>Water xDay</td>
    </tr>
<?php
$query = "SELECT zplant2.plantName, zplant2.gtype,
    zplant2.gxweek, zplant2.org, zplant2.oamount, zplant2.oxweek, zplant2.pesticide,
    zplant2.pamount, zplant2.pxweek, zplant2.pFood, zplant2.pfamount,
    zplant2.pfxweek, zplant2.sunlevel, zplant2.duration, zplant2.sxday,
    zplant2.wamount, zplant2.wxday
    FROM zuser
    INNER JOIN zuserplants ON zuser.uid = zuserplants.userID
    INNER JOIN zplant2 ON zuserplants.plantID = zplant2.plantid
    WHERE zuser.username = ?";

if (!($stmt = $mysqli->prepare($query))) {
    echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if (!($stmt->bind_param('s', $username))) {
    echo "Bind params failed: " . $stmt->errno . " " . $stmt->error;
}
if (!($result = $stmt->execute())) {
    echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
}
//code taken from http://stackoverflow.com/questions/994041
    $meta = $stmt->result_metadata();
    while($field = $meta->fetch_field()) {
        $params[] = &$row[$field->name];
    }

    call_user_func_array(array($stmt, 'bind_result'), $params);
    while ($stmt->fetch()) {
        echo "<tr>";
        foreach($row as $key => $val) {
            $c[$key] = $val;
            echo "<td>" . $c[$key] . "</td>";
        }
        echo "</tr>";
    }
    $stmt->close();
?>
</table>
</div>
</body>
</html>

