<?php
//Turn on error reporting
ini_set('display_errors', 'On');
error_reporting(E_ALL);
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","petleya-db","h4QQvoY9jtkpIVYy","petleya-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <body>
    <div>
      <table>
	    <tr>
		  <td>Plant Data</td>
	    </tr>
	    <tr>
		  <td>Plant ID</td>
		  <td>Plant Name</td>
		  <td>Sun level</td>
	    </tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT zplant.plantid, zplant.plantName, zsun.level FROM zplant INNER JOIN zplantsun ON zplant.plantid = zplantsun.plantid INNER JOIN zsun ON zplantsun.sid = zsun.sid"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($plantid, $plantname,  $level)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $plantid . "\n</td>\n<td>\n" . $plantname."\n</td>\n<td>\n".$level."\n</td>\n</tr>";
}
$stmt->close();
?>
      </table>
    </div>
  </body>
</html>