<?php
  //Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","petleya-db","h4QQvoY9jtkpIVYy","petleya-db");
if($mysqli->connect_errno){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Add Plant</title>
  </head>
  <body>
  <h3 class = "title">Add a Plant</h3>
  <form action="addplant.php" method="POST">
    <span class="sectiontitle">Plant:</span><br><br>
    <table class="outputTable">
    <tr>
	<td><span> Name: </span><br>
            <input type="text" name="plantName"><br><br>
	<td><span> Grooming Type: </span><br>
              <input type="text" name="groomtype"><br>
	<span> Times per Week: </span><br>
            <input type="number" name="gxweek"><br><br>
    <tr>    
	<td><span> Organic: </span><br>
            <input type="text" name="organic"><br>
	<span> Amount: </span><br>
            <input type="number" name="oamount"><br>
	<span> Times per Week: </span><br>
            <input type="number" name="oxweek"><br><br>
	<td><span> Pesticides: </span><br>
            <input type="text" name="pesticide"><br>
	<span> Amount: </span><br>
            <input type="number" name="pamount"><br>
	<span> Times per Week: </span><br>
            <input type="number" name="pxweek"><br><br>
    <tr>
	<td><span> Food: </span><br>
            <input type="text" name="pFood"><br>
	<span> Amount: </span><br>
            <input type="number" name="pfamount"><br>
	<span> Times per Week: </span><br>
            <input type="number" name="pfxweek"><br><br>
	<td><span> Sun Level: </span><br>
            <input type="text" name="slevel"><br>
	<span> Duration: </span><br>
            <input type="number" name="duration"><br>
	<span> Times per Day: </span><br>
            <input type="number" name="sxweek"><br><br>
    <tr>
	<td><span> Amount of Water: </span><br>
            <input type="number" name="wamount"><br>
	<span> Times per Day: </span><br>
            <input type="number" name="wxday"><br><br><br>
        <td>
    </table><br><br>
        
            <input type="submit" value="ADD">
<?php
//check for empty form plant name field
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if ( empty($_POST["plantName"]) ) {
			echo "You must enter a plant name.";
		}
		$plantName = $_POST["plantName"];
		$groomtype = $_POST["groomtype"];
		$gxweek = $_POST["gxweek"];
		$organic = $_POST["organic"];
		$oamount = $_POST["oamount"];
		$oxweek = $_POST["oxweek"];
		$pesticide = $_POST["pesticide"];
		$pamount = $_POST["pamount"];
		$pxweek = $_POST["pxweek"];
		$pFood = $_POST["pFood"];
		$pfamount = $_POST["pfamount"];
		$pfxweek = $_POST["pfxweek"];
		$slevel = $_POST["slevel"];
		$duration = $_POST["duration"];
		$sxweek = $_POST["sxweek"];
		$wamount = $_POST["wamount"];
		$wxday = $_POST["wxday"];
		echo '<br>';
//prepare
		if ( !($stmt = $mysqli->prepare("SELECT COUNT(plantName) FROM zplant2 WHERE plantName = '$plantName'")) ) {
			echo 'Prepare failed: (' . $mysqli->errno . ') '. $mysqli->error;
		}
//bind and execute results
		if (!$stmt->execute()) {
			echo 'Execute failed: (' . $mysqli->errno . ') ' . $mysqli->error;
		}
		if ( !$stmt->bind_result($outNum) ) {
			echo 'Binding output parameters failed: (' .$stmt->errno . ') ' . $stmt->error;
		}
		$stmt->fetch();
		/* explicit close recommended */
		$stmt->close();
		if ($outNum == 1) {
			echo "**Plant with this name already exists.**";
		}
		else {
/* Prepared statement, stage 1: prepare */
			if (!($stmt = $mysqli->prepare("INSERT INTO zplant2(plantName, gtype, gxweek, org, oamount, oxweek, pesticide, pamount, pxweek, pFood, pfamount, pfxweek, sunlevel, duration, sxday, wamount, wxday) VALUES (?, ?, ?, ?, ?, ?, ? ,?, ?, ?, ?, ?, ?, ?, ? ,?, ?)"))) {
				echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			}
/* Prepared statement, stage 2: bind and execute */
			if (!$stmt->bind_param("ssisiisiisiisiiii", $plantName, $groomtype, $gxweek, $organic, $oamount, $oxweek, $pesticide, $pamount, $pxweek, $pFood, $pfamount, $pfxweek, $slevel, $duration, $sxweek, $wamount, $wxday)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			if (!$stmt->execute()) {
				echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			}
/* explicit close recommended */
			$stmt->close();

			echo "$plantName SUCCESSFULLY ADDED";
		}
	}
?>
    </body>
</html>

